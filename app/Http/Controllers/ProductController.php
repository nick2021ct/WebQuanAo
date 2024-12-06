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
        $products = Product::withTrashed()->get();
        // dd($products);
        $images = Image::all();
        $products->load(['size', 'category', 'brand']);
        foreach($products as $product){
            //Lấy ra ảnh đầu tiên làm ảnh đại diện cho sản phẩm
            foreach($images as $image){
                if($image->idProduct == $product->id){
                    $product->image = $image;
                    break;
                }
            }
            ///// tính tổng số lượng sản phẩm theo size hiện có
            $product->number = $product->size->S + $product->size->M + $product->size->L + $product->size->XL + $product->size->XXL + $product->size->XXXL;
            //hiển thị size đang còn của sản phẩm
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
        return view('admin.product.index', compact('products'));
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
    // :

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
        //thêm sản phẩm
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
        toastr()->success('Successfully', 'Added product');
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
     * 
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
                //xóa trong storage
                Storage::delete('public/images/products/'.$image->srcImage);
                //xóa trong database
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
        toastr()->success('Successfully', 'Updated product');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        toastr()->success('Successfully', 'Deleted product');
        return redirect()->route('product.index');
    }

    public function restore($idProduct){
        $product = Product::withTrashed()->where('id', $idProduct)->first();
        // dd($product);
        $product->restore();
        toastr()->success('Successfully', 'Restored  product');
        return redirect()->route('product.index');
    }
}