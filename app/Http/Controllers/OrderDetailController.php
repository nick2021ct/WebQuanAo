<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function listOrder()
    {
        $orders = Order::where('idUser', Auth::user()->id)->orderByDesc('created_at')->get();
        return view('order.listOrder', compact('orders'));
    }
    public function detailOrder($id)
    {
        $products = Cart::where('idOrder', $id)->with('product')->get();
        $products->load(['product' => function ($query) {
            $query->withTrashed(); 
        }]);
        foreach ($products as $cart) {
            $cart->total = $cart->product->priceSale * $cart->qty;
        }
        $order = Order::findOrFail($id);
        $user = User::where('id', $order->idUser)->first();
        return view('order.detailOrder', compact('user', 'products', 'order'));
    }
    public function updateStatusOrder($id){

        $bill = Order::find($id);
        $bill->status = 6;
        $bill->save();
        toastr()->success('Huỷ đơn thành công', 'Updates order');
        return redirect()->back();
    }
}
