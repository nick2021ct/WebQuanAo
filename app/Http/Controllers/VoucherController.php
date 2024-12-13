<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
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
    public function create()
    {
        return view('admin.voucher.create');
    }

   
    /**
     * Storeee a newly created resource in storage.
     *///
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'dateStart' => 'required',
            'dateEnd' => 'required',
            'number' => 'required',
            'value' => 'required',
        ]);
        Voucher::create([
            'name' => $request->name,
            'code' => $request->code,
            'dateStart' => $request->dateStart,
            'dateEnd' => $request->dateEnd,
            'number' => $request->number,
            'value' => $request->value,
        ]);
        toastr()->success('Successfully', 'Added voucher');
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
    public function edit(Voucher $voucher)
    {
        return view('admin.voucher.edit', compact('voucher'));
    }

    /**
     * Update Voucher
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
        $voucher->fill([
            'name' => $request->name,
            'code' => $request->code,
            'dateStart' => $request->dateStart,
            'dateEnd' => $request->dateEnd,
            'number' => $request->number,
            'value' => $request->value,
        ])->save();
        toastr()->success('Successfully', 'Updated voucher');
        return redirect()->route('voucher.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        toastr()->success('Successfully', 'Deleted voucher');
        return redirect()->route('voucher.index');
    }
}
