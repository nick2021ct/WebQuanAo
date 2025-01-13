<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $idProduct)
    {   
      
        if($request->size == null){
            toastr()->error('Vui lòng chọn size','Error');
            return redirect()->back();
        }
        if(!is_numeric($request->qty) ||  $request->qty == null || $request->qty < 1){
            toastr()->error('Vui lòng chọn số lượng','Error');
            return redirect()->back();
            
        }
       
        
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
        if ($cart->idProduct == $idProduct && $cart->size == $request->size) {
            // Cart::where('id', $cart->id)->update(['qty' => $cart->qty + $request->qty]);
            $cart = Cart::find($cart->id);
            $product = Product::with('size')->findOrFail($cart->idProduct);
            if($cart->qty + $request->qty == $product->size->{$cart->size}){
                $cart->qty = $product->size->{$cart->size};
            }else{
                $cart->qty = $cart->qty + $request->qty;
            }
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
            $product = Product::with('size')->findOrFail($cart->idProduct);
            $cart->stock = $product->size->{$cart->size};
            $cart->total = $cart->product->priceSale * $cart->qty;
            $totalBill += $cart->total;
        }
        // dd($carts);
        return view('order.cart', compact('carts', 'totalBill'));
    }
    public function deleteInCart($id)
    {
        Cart::where('id', $id)->delete();
        toastr()->success('success', 'Sản phẩm đã bị xoá');
        return redirect()->route('viewCart');
    }
    public function updateCart(Request $request)
    {
        $carts = Cart::where('idUser', Auth::user()->id)->where('idOrder', null)->get();
        
        foreach ($carts as $cart) {
            $product = Product::with('size')->findOrFail($cart->idProduct);
            $id = $cart->id;
            if (!isset($product->size->{$cart->size}) || $product->size->{$cart->size} < $request->$id) {
                toastr()->error('Không đủ sản phẩm trong kho hàng','Error');
                return redirect()->back();
            }elseif($request->$id < 1){
                toastr()->error('Sản phẩm phải lớn hơn 1','Error');
                return redirect()->back();
            }else{
                $cart = Cart::where('id', $cart->id)->update(['qty' => $request->$id]);
            }
        }
        toastr()->success('success', 'Cập nhật giỏ hàng thành công');
        return redirect()->route('viewCart');
    }
}
