<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories =Category::all();
        $brands = Brand::all();
        $query = Product::query()->with('size');
        if ($request->category_id != null) {
            $query->where('idCategory', $request->category_id);
            }
        if ($request->brand_id != null) {
            $query->where('idBrand', $request->brand_id);
            }
        // if ($request->size != null) {
        //     $query->where({$request->size}, $request->category_id);
        //     }
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
            }
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $column = 'priceSale';
            if (!$query->whereNotNull($column)->exists()) {
                $column = 'price';
            }
            $query->whereBetween($column, [$request->min_price, $request->max_price]);
        }    
        if ($request->has('created_at')) {
            $query->where('created_at', 'like', '%' . $request->created_at .
            '%');
            }
        
        $products = $query->withTrashed()->orderByDesc('created_at')->get();
        // dd($products);
        foreach($products as $product){

            
            $product->number = $product->size->S + $product->size->M + $product->size->L + $product->size->XL + $product->size->XXL + $product->size->XXXL;
            
            $product->sizeShow = '';
            if($product->size->S > 0){
                $product->sizeShow .= ' S';
            }
            if($product->size->M > 0){
                $product->sizeShow .= ' M';
            }
            if($product->size->L > 0){
                $product->sizeShow .= ' L';
            }
            if($product->size->XL > 0){
                $product->sizeShow .= ' XL';
            }
            if($product->size->XXL > 0){
                $product->sizeShow .= ' XXL';
            }
            if($product->size->XXXL > 0){
                $product->sizeShow .= ' XXXL';
            }
            
        }
        return view('admin.product.index', compact('products','categories','brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.product.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function uploadImage($request){
        //Xử lí upload nhiều ảnh
        $arrayName = [];
        foreach($request->images as $image){
            $name = $image->getClientOriginalName();
            $image->storeAs('public/images/products', $name);
            array_push($arrayName, $name);
        }
        return $arrayName;
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'priceSale' => 'required',
            'images' => 'required',
            'description' => 'required',
        ],[
            'images.required' => 'The image field is required.'
        ]);
        
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'priceSale' => $request->priceSale,
            'gender' => $request->gender,
            'description' => $request->description,
            'idCategory' => $request->category,
            'idBrand' => $request->brand,
        ];
        Product::create($data);
        //lấy ra id sản phẩm vừa thêm
        $idProduct = Product::orderBy('id', 'DESC')->first()->id;
        //thực hiện thêm ảnh của sản phẩm vào table Images
        $arrayNameImage =  $this->uploadImage($request);
        foreach($arrayNameImage as $nameImage){
            Image::create([
                'srcImage' => $nameImage,
                'idProduct' => $idProduct,
            ]);
        }
        //thêm số lượng sản phẩm theo size
        Size::create([
            'S' => $request->sizeS,
            'M' => $request->sizeM,
            'L' => $request->sizeL,
            'XL' => $request->sizeXL,
            'XXL' => $request->size2XL,
            'XXXL' => $request->size3XL,
            'idProduct' => $idProduct,
        ]);
        toastr()->success('Successfully', 'Thêm sản phẩm thành công');
        return redirect()->route('product.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $product->load(['size', 'images']);
        return view('admin.product.edit', compact('product', 'brands', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'priceSale' => 'required',
            'description' => 'required',
        ]);
        if($request->images != null){
            // Xóa ảnh cũ
            $images = Image::where('idProduct', $product->id)->get();
            foreach($images as $image){
                Storage::delete('public/images/products/'.$image->srcImage);
                Image::where('id', $image->id)->delete();
            }
            //Thêm ảnh mới
            $arrayNameImage = $this->uploadImage($request);
            foreach($arrayNameImage as $nameImage){
                Image::create([
                    'srcImage' => $nameImage,
                    'idProduct' => $product->id,
                ]);
            }
        }
        $product->fill([
            'name' => $request->name,
            'price' => $request->price,
            'priceSale' => $request->priceSale,
            'gender' => $request->gender,
            'description' => $request->description,
            'idCategory' => $request->category,
            'idBrand' => $request->brand
        ])->save();
        Size::where('idProduct', $product->id)->update([
            'S' => $request->sizeS,
            'M' => $request->sizeM,
            'L' => $request->sizeL,
            'XL' => $request->sizeXL,
            'XXL' => $request->size2XL,
            'XXXL' => $request->size3XL,
        ]);
        toastr()->success('Successfully', 'Cập nhật sản phẩm thành công');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        toastr()->success('Successfully', 'Xoá sản phẩm thành công');
        return redirect()->route('product.index');
    }

    public function restore($idProduct){
        $product = Product::withTrashed()->where('id', $idProduct)->first();
        // dd($product);
        $product->restore();
        toastr()->success('Successfully', 'Đặt lại sản phẩm thành công');
        return redirect()->route('product.index');
    }
}