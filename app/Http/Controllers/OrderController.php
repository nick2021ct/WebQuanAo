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

    public function deleteInCart($id)
    {
        Cart::where('id', $id)->delete();
        return redirect()->route('viewCart')->with('success', 'The product has been removed');
    }
    public function updateCart(Request $request)
    {
        $carts = Cart::where('idUser', Auth::user()->id)->where('idOrder', null)->get();
        foreach ($carts as $cart) {
            $id = $cart->id;
            Cart::where('id', $cart->id)->update(['qty' => $request->$id]);
        }
        return redirect()->route('viewCart')->with('success', 'Cart updated');
    }

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

        if ($request->paymentMethod == 0) {
            return redirect()->route('completePayment', ['payment' => 0, 'idOrder' => $order->id]);
        } else {
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('completePayment');
            $vnp_TmnCode = "6K3DF5SK"; //Mã website tại VNPAY 
            $vnp_HashSecret = "LQUKRDDKIULFZTMZTAZTRMTDUMPZMJKW"; //Chuỗi bí mật

            $vnp_TxnRef = $order->id;
            $vnp_OrderInfo = Auth::user()->fullname . ' thanh toán.';
            $vnp_OrderType = 'Thanh toán online';
            $vnp_Amount = $order->total  * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            //Billing
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        }
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
        if ($request->vnp_ResponseCode == "00") {
            $idOrder = $request->vnp_TxnRef;
            $voucherCode = session('voucher_code');

            if ($voucherCode) {
                $voucher = Voucher::where('code', $voucherCode)->first();

                if (!is_null($voucher) && $voucher->number > 0) {
                    // Update the voucher's remaining uses
                    $voucher->update(['number' => $voucher->number - 1]);
                }
            }
            Order::where('id', $idOrder)->update(['pay' => 1]);
            $bill = Order::Where('id', $idOrder)->first();
            $email = Auth::user()->email;
            $carts = Cart::where('idOrder', $idOrder)->get();
            $totalBill = 0;
            foreach ($carts as $cart) {
                $cart->total = $cart->qty * $cart->product->priceSale;
                $totalBill += $cart->total;

                $product = Product::with('size')->findOrFail($cart->idProduct);
                $product->size->{$cart->size} -= $cart->qty;
                $product->size->save();
            }
            Mail::to($email)->send(new OrderSuccessfully($bill, $carts, $totalBill));
            return view('order.completePayment');
        }

        return redirect('/')->with('error', 'Lỗi trong quá trình thanh toán phí dịch vụ');
    }
   
}

