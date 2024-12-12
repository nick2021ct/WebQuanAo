<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillControllerAdmin extends Controller
{
    public function index(){
        return view('admin.bill.index');
    }
    public function detailBill($id){
       
        return view('admin.bill.detailBill');
    }
}
