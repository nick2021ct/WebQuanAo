<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withTrashed()->get();
        foreach($categories as $category){
            $category->qty = Product::where('idCategory', $category->id)->count();
        };
        return view('admin.category.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);
        $data = [
            'name' => $request->name,
            'description' => $request->description
        ];
        Category::create($data);
        toastr()->success('Successfully', 'Added category');
        return redirect()->route('category.index');
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
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category->fill([
            'name' => $request->name,
            'description' => $request->description
        ])->save();
        toastr()->success('Successfully', 'Updated category');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        //xóa tất cả sản phẩm thuộc danh mục bị xóa
        Product::where('idCategory', $category->id)->delete();
        toastr()->success('Successfully', 'Deleted category');
        return redirect()->route('category.index');
    }

    public function restore($idCategory){
        Category::where('id', $idCategory)->restore();
        //khôi phục tất cả sản phẩm thuộc danh mục bị xóa
        Product::where('idCategory', $idCategory)->restore();
        toastr()->success('Successfully', 'Restored category');
        
    }
}