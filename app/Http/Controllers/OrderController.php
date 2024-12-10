<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    public function discountCode(Request $request)
    {
        $voucher = Voucher::where('code', $request->code)->first();
        if (!is_null($voucher)) {
            if ($voucher->number > 0) {
                $nowDay = Carbon::now();
                if ($nowDay >= $voucher->dateStart && $nowDay < $voucher->dateEnd) {
                    $user = Auth::user();
                    $carts = Cart::where('idUser', $user->id)->where('idOrder', null)->get();
                    $carts->load('product');
                    $totalBill = 0;
                    foreach ($carts as $cart) {
                        $totalBill += $cart->qty * $cart->product->priceSale;
                    }
                    // Voucher::where('code', $request->code)->update(['number' => $voucher->number - 1]);
                    $request->session()->put('voucher_code', $request->code);
                    return view('order.checkOut', compact('user', 'carts', 'voucher', 'totalBill'));
                } else {
                    return redirect()->route('checkOut')->with('error', 'Code has expired');
                }
            } else {
                return redirect()->route('checkOut')->with('error', 'Code has expired');
            }
        } else {
            return redirect()->route('checkOut')->with('error', 'Code does not exist');
        }
    }

    public function getFormCheckOut()
    {
        $user = Auth::user();
        $carts = Cart::where('idUser', $user->id)->where('idOrder', null)->get();
        $carts->load('product');
        $totalBill = 0;
        foreach ($carts as $cart) {
            $totalBill += $cart->qty * $cart->product->priceSale;
        }
        return view('order.checkOut', compact('user', 'carts', 'totalBill'));
    }

    public function submitFormCheckOut(Request $request)
    {
        $data = [
            'idUser' => Auth::user()->id,
            'total' => $request->total,
            'paymentMethod' => $request->paymentMethod,
            'status' => 1,
            'pay' => 0
        ];
        if($request->paymentMethod == null){
            return redirect()->back()->with('error', 'Vui lòng chọn phương thức thanh toán');
        }
        if ($request->orderId) {
            $order = Order::find($request->orderId);
            // dd($order);
        } else {
            $order = Order::create($data);
        }
        Cart::where('idOrder', null)->where('idUser', $order->idUser)->update([
            'idOrder' => $order->id
        ]);

       
    }

    public function completePayment(Request $request)
    {

        if ($request->payment != null && $request->payment == 0) {
            $idOrder = $request->idOrder;
            Order::where('id', $idOrder)->update(['pay' => 1]);
            $carts = Cart::where('idOrder', $idOrder)->get();
            
            foreach ($carts as $cart) {
                $product = Product::with('size')->findOrFail($cart->idProduct);
                $product->size->{$cart->size} -= $cart->qty;
                $product->size->save();
            }
            return view('order.completePayment');
        
        }
       
        return redirect('/')->with('error', 'Lỗi trong quá trình thanh toán phí dịch vụ');
    }
   
}

