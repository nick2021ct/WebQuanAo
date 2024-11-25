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
            //tính tổng số lượng sản phẩm theo size hiện có
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
}