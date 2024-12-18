<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Spatie\Permission\Models\Permission;
use PDF;

class BillControllerAdmin extends Controller
{
    public function index(){
        $bills = Order::orderByDesc('id')->get();
        $bills->load('user');
        return view('admin.bill.index', compact('bills'));
    }
    public function detailBill($id){
        $images = Image::all();
        $bill = Order::where('id', $id)->first();
        $carts = Cart::where('idOrder', $id)->get();
        $carts->load(['product' => function ($query) {
            $query->withTrashed(); // Load cả sản phẩm đã bị xóa
        }]);;
        $totalBill = 0;
        foreach($carts as $cart){
            $cart->total = $cart->product->priceSale * $cart->qty;
            $totalBill += $cart->total;
            foreach($images as $image){
                if($image->idProduct == $cart->product->id){
                    $cart->product->srcImage = $image->srcImage;
                    break;
                }
            }
        }
        return view('admin.bill.detailBill', compact('bill', 'carts', 'totalBill'));
    }
    public function updateBill($id, Request $request){
        Order::where('id', $id)->update(['status' => $request->status]);
        toastr()->success('Successfully', 'Updates order');
        return redirect()->route('bill.index');
    }
    public function invoice($id){
        $images = Image::all();
        $bill = Order::where('id', $id)->first();
        $carts = Cart::where('idOrder', $id)->get();
        $carts->load(['product' => function ($query) {
            $query->withTrashed(); // Load cả sản phẩm đã bị xóa
        }]);;
        $totalBill = 0;
        foreach($carts as $cart){
            $cart->total = $cart->product->priceSale * $cart->qty;
            $totalBill += $cart->total;
            foreach($images as $image){
                if($image->idProduct == $cart->product->id){
                    $cart->product->srcImage = $image->srcImage;
                    break;
                }
            }
        }
        $pdf = PDF::loadView('admin.bill.billPDF', array('bill' => $bill, 'carts' => $carts, 'totalBill' => $totalBill));
        return $pdf->download('bill_'.$id.'.pdf');
    }
}