<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::withTrashed()->get();
        foreach($brands as $brand){
            $brand->qty = Product::where('idBrand', $brand->id)->count();
        };
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands',
        ]);
        $data = [
            'name' => $request->name,
            'description' => $request->description
        ];
        Brand::create($data);
        toastr()->success('Successfully', 'Added brand');
        return redirect()->route('brand.index');
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
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $brand->fill([
            'name' => $request->name,
            'description' => $request->description,
        ])->save();
        toastr()->success('Successfully', 'Updated brand');
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        //xóa tất cả sản phẩm thuộc brand bị xóa
        Product::where('idBrand', $brand->id)->delete();
        toastr()->success('Successfully', 'Deleted brand');
        return redirect()->route('brand.index');
    }

    public function restore($idBrand){
        Brand::where('id', $idBrand)->restore();
        //khôi phục tất cả sản phẩm thuộc brand bị xóa
        Product::where('idBrand', $idBrand)->restore();
        toastr()->success('Successfully', 'Restored brand');
        return redirect()->route('brand.index');
    }
}
