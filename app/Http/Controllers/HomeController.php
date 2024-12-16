<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function home()
    {
        $banners = Banner::get();
        $products = Product::orderByDesc('view')->limit(8)->get();
        $blogs = Blog::select('id', 'title', 'created_at')
            ->with(['image' => function ($query) {
                $query->select('id', 'idBlog', 'srcImage');
            }])
            ->orderBy('created_at', 'desc') // Order by creation date in descending order
            ->limit(3)
            ->get();
        $images = Image::all();
        //Lấy ra ảnh đầu tiên làm ảnh đại diện cho sản phẩm
        foreach ($products as $product) {
            foreach ($images as $image) {
                if ($image->idProduct == $product->id) {
                    $product->image = $image;
                    break;
                }
            }
        }
        return view('index', compact('banners', 'products', 'blogs'));
    }


    

    public function listProduct(Request $request)
    {
        $categories = Category::get();
        $brands = Brand::get();
        $query = Product::query();
        // Apply filters based on request inputs for non-Ajax requests
        // bộ lọc 
        if ($request->input('category')) {
            $query->where('idCategory', $request->input('category'));
        }

        if ($request->input('brand')) {
            $query->where('idBrand', $request->input('brand'));
        }

        if ($request->input('priceSaleGap')) {
            if ($request->input('priceSaleGap') == '500000+') {
                $query->where('priceSale', '>=', 500000);
            } else {
                $priceRange = explode('-', $request->input('priceSaleGap'));
                $query->whereBetween('priceSale', [$priceRange[0], $priceRange[1]]);
            }
        }

        if ($request->input('priceSale')) {
            $query->orderBy('priceSale', $request->input('priceSale'));
        }

        if ($request->input('search')) {
            // Only apply search condition if category is not provided
            if (!$request->input('category') && !$request->input('brand') && !$request->input('priceSaleGap')) {
                $query->where('name', 'like', '%' . $request->input('search') . '%');
            }
        }

        $products = $query->with('images')->paginate(12);
        $productIds = $products->pluck('id')->toArray();
        $images = Image::whereIn('idProduct', $productIds)->get();

        // Assign images to paginated products
        foreach ($products as $product) {
            $product->image = $images->where('idProduct', $product->id)->first();
        }


        // Eager load images for products

        // Return view based on request type
        if ($request->ajax()) {
            return view('product.pagination_data', compact('products', 'categories', 'brands', 'images'))->render();
        } else {
            return view('product.productList', compact('products', 'categories', 'brands'));
        }
    }

    public function detailProduct($id)
    {
        $product = Product::where('id', $id)->first();
        $comments = Comment::where('idProduct', $id)->with('user')->get();
        $countCommentUser = Comment::where('idProduct', $id)->where('idUser', optional(Auth::user())->id)->count();
        $averageRating = $product->averageRating();
        $product->load('size', 'category', 'brand');
        $images = Image::where('idProduct', $id)->get();

        $productImage = $images->where('idProduct', $product->id)->first();

        $cart = Cart::where('idProduct', $id)->where('idUser', optional(Auth::user())->id)->first();

        if ($cart) {
            $order = Order::where('id', $cart->idOrder)
                ->where('pay', 1) // Thêm điều kiện kiểm tra trường pay
                ->first();
        } else {
            $order = null; // Đặt $order thành null nếu không có giỏ hàng
        }

        $relatedProducts = Product::where('idCategory', $product->idCategory)->where('idBrand', $product->idBrand)->where('id', '<>', $product->id)->take(4)->get();
        //gán ảnh
        foreach ($relatedProducts as $relatedProduct) {
            $relatedProduct->srcImage = Image::where('idProduct', $relatedProduct->id)->first()->srcImage;
        }
        //tăng lượt xem 
        Product::where('id', $id)->update(['view' => $product->view + 1]);
        return view('product.productDetail', compact('product', 'images', 'relatedProducts', 'comments', 'averageRating', 'cart', 'countCommentUser', 'productImage', 'order'));
    }
    public function listProductByCategory($id)
    {
        $categories = Category::get();
        $brands = Brand::get();
        $products = Product::where('idCategory', $id)->get();

        $images = Image::all();
        //Lấy ra ảnh đầu tiên làm ảnh đại diện cho sản phẩm
        foreach ($products as $product) {
            foreach ($images as $image) {
                if ($image->idProduct == $product->id) {
                    $product->image = $image;
                    break;
                }
            }
        }
        return view('product.productList', compact('products', 'categories', 'brands'));
    }
    public function listProductByBrand($id)
    {
        $categories = Category::get();
        $brands = Brand::get();
        $products = Product::where('idBrand', $id)->get();
        $images = Image::all();
        //Lấy ra ảnh đầu tiên làm ảnh đại diện cho sản phẩm
        foreach ($products as $product) {
            foreach ($images as $image) {
                if ($image->idProduct == $product->id) {
                    $product->image = $image;
                    break;
                }
            }
        }
        return view('product.productList', compact('products', 'categories', 'brands'));
    }
    public function searchProduct(Request $request)
    {
        $categories = Category::get();
        $brands = Brand::get();
        $products = Product::where('name', 'like', '%' . $request->kyw . '%')->paginate(1);
        $images = Image::all();
        //Lấy ra ảnh đầu tiên làm ảnh đại diện cho sản phẩm
        foreach ($products as $product) {
            foreach ($images as $image) {
                if ($image->idProduct == $product->id) {
                    $product->image = $image;
                    break;
                }
            }
        }
        return view('product.productList', compact('products', 'categories', 'brands'));
    }


    public function searchHome(Request $request)
    {
        $categories = Category::get();
        $brands = Brand::get();
        $products = Product::where('name', 'like', '%' . $request->kyw . '%')->paginate(1);
        $images = Image::all();
        //Lấy ra ảnh đầu tiên làm ảnh đại diện cho sản phẩm
        foreach ($products as $product) {
            foreach ($images as $image) {
                if ($image->idProduct == $product->id) {
                    $product->image = $image;
                    break;
                }
            }
        }
        return view('product.productList', compact('products', 'categories', 'brands'));
    }
    public function searchBlog(Request $request)
    {
        $categories = Category::get();
        $brands = Brand::get();
        $products = Product::where('name', 'like', '%' . $request->kyw . '%')->paginate(1);
        $images = Image::all();
        //Lấy ra ảnh đầu tiên làm ảnh đại diện cho sản phẩm
        foreach ($products as $product) {
            foreach ($images as $image) {
                if ($image->idProduct == $product->id) {
                    $product->image = $image;
                    break;
                }
            }
        }
        return view('product.productList', compact('products', 'categories', 'brands'));
    }
    public function searchsp(Request $request)
    {
        $categories = Category::get();
        $brands = Brand::get();
        $products = Product::where('name', 'like', '%' . $request->kyw . '%')->paginate(1);
        $images = Image::all();
        //Lấy ra ảnh đầu tiên làm ảnh đại diện cho sản phẩm
        foreach ($products as $product) {
            foreach ($images as $image) {
                if ($image->idProduct == $product->id) {
                    $product->image = $image;
                    break;
                }
            }
        }
        return view('product.productList', compact('products', 'categories', 'brands'));
    }
    public function searchMore(Request $request)
    {
        $categories = Category::get();
        $brands = Brand::get();
        $products = Product::where('name', 'like', '%' . $request->kyw . '%')->paginate(1);
        $images = Image::all();
        //Lấy ra ảnh đầu tiên làm ảnh đại diện cho sản phẩm
        foreach ($products as $product) {
            foreach ($images as $image) {
                if ($image->idProduct == $product->id) {
                    $product->image = $image;
                    break;
                }
            }
        }
        return view('product.productList', compact('products', 'categories', 'brands'));
    }
}