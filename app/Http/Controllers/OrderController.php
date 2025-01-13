<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\Size;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccessfully;
use App\Models\Address;
use App\Models\Product;
use App\Models\VoucherDetail;

class OrderController extends Controller
{
    public function discountCode(Request $request)
    {
        $voucher_code = $request->code ?? $request->selectCode;

        $voucher = Voucher::where('code', $voucher_code)->first();
        //nếu tồn tại
        if (!is_null($voucher)) {
            //còn hay không
            if ($voucher->number > 0) {
                $voucher_detail = VoucherDetail::where('idUser',Auth::id())->where('idVoucher',$voucher->id)->first();
                if($voucher_detail !== null){
                    //Check ngày bắt đầu và ngày kết thúc code 
                    $nowDay = Carbon::now();
                    if ($nowDay >= $voucher->dateStart && $nowDay < $voucher->dateEnd) {
                    
                        $user = Auth::user();
                        $carts = Cart::where('idUser', $user->id)->where('idOrder', null)->get();
                        $carts->load('product');
                        $totalBill = 0;
                        foreach ($carts as $cart) {
                            $totalBill += $cart->qty * $cart->product->priceSale;
                        }
                        if($totalBill >= $voucher->value){
                            $voucherList = Voucher::whereHas('voucher_detail', function ($query) {
                                $query->where('idUser', Auth::id());
                            })
                            ->where('dateEnd','>', today())
                            ->where('dateStart','<=', today())
                            ->get();
                            $addresses = Address::where('idUser', $user->id)->get();
                            $request->session()->put('voucher_code', $voucher_code);
                            return view('order.checkOut', compact('user', 'carts', 'voucher', 'totalBill','addresses','voucherList'));
                        }else{
                            return redirect()->route('checkOut')->with('error', 'Voucher chỉ dành cho giỏ hàng có tổng giá tiền trên '.$voucher->value);
                        }
                    } else {
                        return redirect()->route('checkOut')->with('error', 'Mã đã hết hạn');
                    }
                }else{
                    return redirect()->route('checkOut')->with('error', 'Mã không thuộc quyền sở hữu của bạn');
                }
                
            } else {
                return redirect()->route('checkOut')->with('error', 'Mã đã hết hạn');
            }
        } else {
            return redirect()->route('checkOut')->with('error', 'Mã không tồn tại');
        }
    }
    public function getFormCheckOut()
    {
        $user = Auth::user();
        $addresses = Address::where('idUser', $user->id)->get();
        $carts = Cart::where('idUser', $user->id)->where('idOrder', null)->get();
        $carts->load('product');
        $totalBill = 0;
        $voucherList = Voucher::whereHas('voucher_detail', function ($query) {
            $query->where('idUser', Auth::id());
        })
        ->where('dateEnd','>', today())
        ->where('dateStart','<=', today())
        ->get();
        foreach ($carts as $cart) {
            $product = Product::with('size')->findOrFail($cart->idProduct);
            if($product->size->{$cart->size} < $cart->qty){
                toastr()->error('Sản phẩm không đủ số lượng tồn kho','Error');
                return redirect()->route('viewCart');
            }
            $totalBill += $cart->qty * $cart->product->priceSale;
        }
        return view('order.checkOut', compact('user', 'carts', 'totalBill','addresses','voucherList'));
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
        if($request->paymentMethod == null){
            return redirect()->back()->with('error', 'Vui lòng chọn phương thức thanh toán');
        }
        // if($request->address_id == null){
        //     return redirect()->back()->with('error', 'Vui lòng chọn địa chỉ nhận hàng');
        // }
        if ($request->orderId) {
            $order = Order::find($request->orderId);
            // dd($order);
        } else {
            $order = Order::create($data);
            $address = Address::find($request->address_id);
            $orderAddress = new OrderAddress();
            $orderAddress->idOrder = $order->id;
            $orderAddress->fullname = $address->fullname;
            $orderAddress->phone = $address->phone;
            $orderAddress->address = $address->address;
            $orderAddress->address_type = $address->address_type;
            $orderAddress->zip_code = $address->zip_code;
            $orderAddress->save();
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
            $vnp_OrderInfo = Auth::user()->fullname . ' thanh toán.'; //CHECK
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
            Order::where('id', $idOrder)->update(['pay' => 0]);
            $carts = Cart::where('idOrder', $idOrder)->get();

            $voucherCode = session('voucher_code');
            if ($voucherCode) {
                $voucher = Voucher::where('code', $voucherCode)->first();
                if (!is_null($voucher) && $voucher->number > 0) {
                    $voucher->update(['number' => $voucher->number - 1]);
                }
            }
            foreach ($carts as $cart) {
                $product = Product::with('size')->findOrFail($cart->idProduct);
                if($product->size->{$cart->size} < $cart->qty){
                    toastr()->error('Sản phẩm không đủ số lượng tồn kho','Error');
                    return redirect()->route('viewCart');
                }
                $product->size->{$cart->size} -= $cart->qty;
                $product->size->save();
            }
            return view('order.completePayment');
        
        }
        if ($request->vnp_ResponseCode == "00") {
            //đã thanh toán thành công -> đơn hàng đã được tạo 
            $idOrder = $request->vnp_TxnRef;
            $voucherCode = session('voucher_code');

            if ($voucherCode) {
                $voucher = Voucher::where('code', $voucherCode)->first();
                if (!is_null($voucher) && $voucher->number > 0) {
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
    public function listOrder()
    {
        $orders = Order::where('idUser', Auth::user()->id)->orderByDesc('created_at')->paginate(10);
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

        if(in_array($bill->status,[3,4])){
            toastr()->error('Đơn hàng không thể bị huỷ khi đã được vẫn chuyển', 'Updates order');
        }else{
            $bill->status = 6;
            $bill->save();
            $orderDetails = Cart::where('idOrder',$id)->get();
            foreach($orderDetails as $orderDetail){
                $product = Product::with('size')->findOrFail($orderDetail->idProduct);
                $product->size->{$orderDetail->size} += $orderDetail->qty;
                $product->size->save();
            }
        toastr()->success('Huỷ đơn thành công', 'Updates order');
        
        }
        return redirect()->back();
    }

    public function orderSuccess($id)
    {
        $bill = Order::find($id);
        $bill->pay = 1;
        $bill->status = 4;
        $bill->save();
        return redirect()->back();
    }
}