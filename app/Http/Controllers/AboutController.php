<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $countUser = User::where('role', 0)->count();
        $countProduct = Product::count();
        $countBrand = Brand::count();

        // Truyền dữ liệu đến view
        return view('about.index', ['countProduct' => $countProduct, 'countUser' => $countUser, 'countBrand' => $countBrand]);
    }
}