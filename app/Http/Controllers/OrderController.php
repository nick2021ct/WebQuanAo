<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Order;
use App\Models\Size;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccessfully;


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
        $carts = Cart::where('idUser', Auth::user()->id)->where('idOrder', null)->get();
        $check = true;
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
        }
        return redirect()->back()->with('success', 'Added to cart');
    }
    public function viewCart()
    {
        $images = Image::all();
        $carts = Cart::where('idUser', Auth::user()->id)->where('idOrder', null)->get();
        $carts->load('product');
        $totalBill = 0;
        //Lấy ra ảnh đầu tiên làm ảnh đại diện cho sản phẩm
        foreach ($carts as $cart) {
            $cart->total = $cart->product->priceSale * $cart->qty;
            $totalBill += $cart->total;
            foreach ($images as $image) {
                if ($image->idProduct == $cart->product->id) {
                    $cart->product->srcImage = $image->srcImage;
                    break;
                }
            }
        }
        return view('order.cart', compact('carts', 'totalBill'));
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
        //Check code nhập vào có tồn tại hay không
        $voucher = Voucher::where('code', $request->code)->first();
        //nếu tồn tại
        if (!is_null($voucher)) {
            //Check số lượng code còn hay không
            if ($voucher->number > 0) {
                //Check ngày bắt đầu và ngày kết thúc code 
                $nowDay = Carbon::now('Asia/Ho_Chi_Minh');
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
        //xử lí thêm đơn hàng
        $data = [
            'idUser' => Auth::user()->id,
            'total' => $request->total,
            'paymentMethod' => $request->paymentMethod,
            'status' => 1,
            'pay' => 0
        ];
        if ($request->orderId) {
            $order = Order::find($request->orderId);
            // dd($order);
        } else {
            $order = Order::create($data);
        }
        Cart::where('idOrder', null)->where('idUser', $order->idUser)->update([
            'idOrder' => $order->id
        ]);
        // Trừ số lượng trong kho

        //xử lý thanh toán với vnpay
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
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
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
            return view('order.completePayment');
        }
        if ($request->vnp_ResponseCode == "00") {
            //đã thanh toán thành công -> đơn hàng đã được tạo 
            $idOrder = $request->vnp_TxnRef;
            $voucherCode = session('voucher_code');

            // Check if a voucher code was stored in the session
            if ($voucherCode) {
                // Retrieve the voucher using the stored code
                $voucher = Voucher::where('code', $voucherCode)->first();

                // Check if the voucher exists and has remaining uses
                if (!is_null($voucher) && $voucher->number > 0) {
                    // Update the voucher's remaining uses
                    $voucher->update(['number' => $voucher->number - 1]);
                }
            }
            //cập nhật đã thanh toán cho đơn hàng
            Order::where('id', $idOrder)->update(['pay' => 1]);
            $bill = Order::Where('id', $idOrder)->first();
            $email = Auth::user()->email;
            //giảm số lượng sản phẩm khi đã mua 
            $carts = Cart::where('idOrder', $idOrder)->get();
            $totalBill = 0;
            foreach ($carts as $cart) {
                $cart->total = $cart->qty * $cart->product->priceSale;
                $totalBill += $cart->total;
                $sizeOrder = $cart->size;
                $quantityOld = Size::where('idProduct', $cart->idProduct)->first($sizeOrder)->$sizeOrder;
                Size::where('idProduct', $cart->idProduct)->update([$cart->size => $quantityOld - $cart->qty]);
            }
            //gửi mail hóa đơn
            Mail::to($email)->send(new OrderSuccessfully($bill, $carts, $totalBill));
            return view('order.completePayment');
        }

        return redirect('/')->with('error', 'Error in service fee payment process');
    }
    public function listOrder()
    {
        $orders = Order::where('idUser', Auth::user()->id)->orderByDesc('id')->get();
        return view('order.listOrder', compact('orders'));
    }
    public function detailOrder($id)
    {
        $images = Image::all();
        $products = Cart::where('idOrder', $id)->get();
        $products->load(['product' => function ($query) {
            $query->withTrashed(); // Load cả sản phẩm đã bị xóa
        }]);
        //Lấy ra ảnh đầu tiên làm ảnh đại diện cho sản phẩm
        foreach ($products as $cart) {
            $cart->total = $cart->product->priceSale * $cart->qty;
            foreach ($images as $image) {
                if ($image->idProduct == $cart->product->id) {
                    $cart->product->srcImage = $image->srcImage;
                    break;
                }
            }
        }
        $order = Order::where('id', $id)->first();
        $user = User::where('id', $order->idUser)->first();
        return view('order.detailOrder', compact('user', 'products', 'order'));
        $order = Order::where('id', $id)->first();
        $user = User::where('id', $order->idUser)->first();
        return view('order.detailOrder', compact('user', 'products', 'order'));
        $order = Order::where('id', $id)->first();
        $user = User::where('id', $order->idUser)->first();
        return view('order.detailOrder', compact('user', 'products', 'order'));

        $order = Order::where('id', $id)->first();
        $user = User::where('id', $order->idUser)->first();
        return view('order.detailOrder', compact('user', 'products', 'order'));
        $order = Order::where('id', $id)->first();
        $user = User::where('id', $order->idUser)->first();
        return view('order.detailOrder', compact('user', 'products', 'order'));
    }
}