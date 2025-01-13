<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherDetail;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Voucher::orderByDesc('created_at')->get();
        return view('admin.voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $users = User::all();
        $query = User::query();
        if ($request->filled('fullname')) {
            $query->where('fullname', 'like', '%' . $request->fullname . '%');
        }
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('address')) {
            $query->where('address', $request->address);
        }
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->whereNull('deleted_at');
            } elseif ($request->status === 'blocked') {
                $query->whereNotNull('deleted_at');
            }
        }
        
        $users = $query->withTrashed()
            ->orderByDesc('created_at')
            ->get();
        
        return view('admin.voucher.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'dateStart' => 'required',
            'dateEnd' => 'required',
            'number' => 'required',
            'value' => 'required',
        ]);
        if($request->idUser == null){
            toastr()->success( 'Cần chọn khách hàng','Error');

        }
        Voucher::create([
            'name' => $request->name,
            'code' => $request->code,
            'dateStart' => $request->dateStart,
            'dateEnd' => $request->dateEnd,
            'number' => $request->number,
            'value' => $request->value,
        ]);

        foreach($request->idUser as $user){
            $voucher_detail = new VoucherDetail();
            $voucher_detail->idUser = $user;
            $voucher_detail->idVoucher = Voucher::latest()->first()->id;
            $voucher_detail->save();
        }
        toastr()->success( 'Thêm mã giảm giá thành công','Successfully');
        return redirect()->route('voucher.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucher $voucher, Request $request)
    {
        $query = User::query();
        if ($request->filled('fullname')) {
            $query->where('fullname', 'like', '%' . $request->fullname . '%');
        }
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('address')) {
            $query->where('address', $request->address);
        }
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->whereNull('deleted_at');
            } elseif ($request->status === 'blocked') {
                $query->whereNotNull('deleted_at');
            }
        }
        
        $users = $query->withTrashed()
            ->orderByDesc('created_at')
            ->get();
        
        $allUser = User::all();
        $userVoucherDetails = VoucherDetail::whereIn('idUser', $users->pluck('id'))->get()->keyBy('idUser');
        return view('admin.voucher.edit', compact('voucher','users','userVoucherDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voucher $voucher)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'dateStart' => 'required',
            'dateEnd' => 'required',
            'number' => 'required',
            'value' => 'required',
        ]);
        if($request->idUser == null){
            toastr()->success( 'Cần chọn khách hàng','Error');

        }
        $voucher->fill([
            'name' => $request->name,
            'code' => $request->code,
            'dateStart' => $request->dateStart,
            'dateEnd' => $request->dateEnd,
            'number' => $request->number,
            'value' => $request->value,
        ])->save();
        $voucher_detail = VoucherDetail::where('idVoucher',$voucher->id)->get();
        foreach($voucher_detail as $detail){
            $detail->delete();
        }
        foreach($request->idUser as $user){
            $voucher_detail = new VoucherDetail();
            $voucher_detail->idUser = $user;
            $voucher_detail->idVoucher = Voucher::latest()->first()->id;
            $voucher_detail->save();
        }
        toastr()->success('Successfully', 'Cập nhật mã giảm giá thành công');
        return redirect()->route('voucher.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        toastr()->success('Successfully', 'Xoá mã giảm giá thành công');
        return redirect()->route('voucher.index');
    }
}
