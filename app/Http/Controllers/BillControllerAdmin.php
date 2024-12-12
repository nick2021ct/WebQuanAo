<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillControllerAdmin extends Controller
{
    public function index(){
        $bills = Order::orderByDesc('id')->get();
        $bills->load('user');
        return view('admin.bill.index', compact('bills'));
    }
    public function detailBill($id){
       
        return view('admin.bill.detailBill');
    }
}
