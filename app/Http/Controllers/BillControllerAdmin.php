<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillControllerAdmin extends Controller
{
    public function index(){
        $bills = Order::orderByDesc('id')->get();
        $bills->load('user');
        return view('admin.bill.index', compact('bills'));
    }
    public function detailBill($id){
        $bill = Order::findOrFail($id);
        $carts = Cart::where('idOrder', $id)->get();
        $carts->load(['product' => function ($query) {
            $query->withTrashed(); // Load cả sản phẩm đã bị xóa
            $query->with('images');
        }]);
        $totalBill = 0;
        foreach($carts as $cart){
            $cart->total = $cart->product->priceSale * $cart->qty;
            $totalBill += $cart->total;
        }
        return view('admin.bill.detailBill', compact('bill', 'carts', 'totalBill'));
    }
}
