<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function addToCart(Request $request, $idProduct)
    {   
        $request->validate([
            'size' => 'required',
            'qty' => 'required|integer|gt:0',
        ],[
            'size.required' => 'Vui lòng chọn size.',
            'qty.required' => 'Vui lòng chọn số lượng.',
            'qty.gt' => 'Số lượng phải lớn hơn 1.'
        ]);

        $product = Product::with('size')->findOrFail($idProduct);

        $carts = Cart::where('idUser', Auth::user()->id)
        ->where('idOrder', null)
        ->get();

        $check = true;

        if (!isset($product->size->{$request->size}) || $product->size->{$request->size} < $request->qty) {
            toastr()->error('Sản phẩm nhiều hơn kho hàng','Error');
            return redirect()->back();
        }

        foreach ($carts as $cart) {
        //TH sản phẩm trong giỏ cùng loại với sản phẩm vừa thêm
        if ($cart->idProduct == $idProduct && $cart->size == $request->size) {
            Cart::where('id', $cart->id)->update(['qty' => $cart->qty + $request->qty]);
            $check = false;
            break;
        }
        }
        if ($check == true) {
            Cart::insert([
                'idProduct' => $idProduct,
                'qty' => $request->qty,
                'size' => $request->size,
                'idUser' => Auth::user()->id,
            ]);
            toastr()->success('Thêm giỏ hàng thành công','Success');

        }
        return redirect()->back();
    }
    public function viewCart()
    {
        $carts = Cart::where('idUser', Auth::user()->id)
        ->where('idOrder', null)
        ->with('product')
        ->get();
        $totalBill = 0;
        foreach ($carts as $cart) {
            $cart->total = $cart->product->priceSale * $cart->qty;
            $totalBill += $cart->total;
        }
        return view('order.cart', compact('carts', 'totalBill'));
    }

    public function getFormCheckOut()
    {
        return view('order.checkOut');

    }

    public function completePayment()
    {
        return view('order.completePayment');
    }
}
