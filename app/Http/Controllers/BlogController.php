<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function index()
    {
        $blogs = Blog::select('id', 'title', 'created_at', 'deleted_at')->with(['image' => function ($query) {
            $query->select('id', 'idBlog', 'srcImage');
        }])->orderBy('created_at', 'desc')->get();

        return view('blog.listBlog', compact('blogs'));
    }
    public function show(Blog $blog)
    {
        $latestBlogs = Blog::where('id', '!=', $blog->id)
            ->latest('created_at')
            ->take(2)
            ->get();
    
        return view('blog.detailBlog', compact('blog', 'latestBlogs'));
    }
}