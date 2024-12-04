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
}