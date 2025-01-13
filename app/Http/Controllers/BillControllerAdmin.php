<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Image;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Spatie\Permission\Models\Permission;

class BillControllerAdmin extends Controller
{
    public function index(Request $request){
        $query = Order::query()->with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('pay')) {
            $query->where('pay', $request->pay);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->filled('total_min') && $request->filled('total_max')) {
            $query->whereBetween('total', [$request->total_min, $request->total_max]);
        } elseif ($request->filled('total_min')) {
            $query->where('total', '>=', $request->total_min);
        } elseif ($request->filled('total_max')) {
            $query->where('total', '<=', $request->total_max);
        }

        if ($request->filled('user_name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('fullname', 'like', '%' . $request->user_name . '%');
            });
        }
        $bills = $query->orderByDesc('created_at')->get();
        $bills->load('user');

        return view('admin.bill.index', compact('bills'));
    }
    public function detailBill($id){
        $bill = Order::findOrFail($id);
        $carts = Cart::where('idOrder', $id)->get();
        $carts->load(['product' => function ($query) {
            $query->withTrashed(); 
            $query->with('images');
        }]);
        $billAddress = OrderAddress::where('idOrder',$id)->first();
        $totalBill = 0;
        foreach($carts as $cart){
            $cart->total = $cart->product->priceSale * $cart->qty;
            $totalBill += $cart->total;
        }
        return view('admin.bill.detailBill', compact('bill', 'carts', 'totalBill','billAddress'));
    }
    public function updateBill($id, Request $request){

        $bill = Order::findOrFail($id);
        if(in_array($bill->status,[3,4]) && $request->status == 6){
            toastr()->error( 'Đơn hàng không thể bị huỷ khi đã được vẫn chuyển','Error');
        }
        if(in_array($bill->status,[4,5,6]) ){
            toastr()->error( 'Không thể thay đổi trạng thái đơn hàng đã huỷ hoặc đã được giao','Error');
        }
        if(in_array($request->status,[5,6])){
            $orderDetails = Cart::where('idOrder',$id)->get();
            foreach($orderDetails as $orderDetail){
                $product = Product::with('size')->findOrFail($orderDetail->idProduct);
                $product->size->{$orderDetail->size} += $orderDetail->qty;
                $product->size->save();
            }

            $bill->status = $request->status;
            $bill->save();
            toastr()->success( 'Đơn hàng đã được cập nhật','Successfully');
        }
        if($request->status == 4){
            $bill->pay = 1;
            $bill->save();
            toastr()->success( 'Đơn hàng đã được cập nhật','Successfully');
        }
            $bill->status = $request->status;
            $bill->save();
            // toastr()->success('Successfully', 'Đơn hàng đã được cập nhật');
            return redirect()->back();
        
    }
    public function invoice($id){
        $bill = Order::findOrFail($id);
        $carts = Cart::where('idOrder', $id)->get();
        $carts->load(['product' => function ($query) {
            $query->withTrashed(); 
        }]);;
        $totalBill = 0;
        foreach($carts as $cart){
            $cart->total = $cart->product->priceSale * $cart->qty;
            $totalBill += $cart->total;
        }
        $pdf = PDF::loadView('admin.bill.billPDF', array('bill' => $bill, 'carts' => $carts, 'totalBill' => $totalBill));
        return $pdf->download('bill_'.$id.'.pdf');
    }
}