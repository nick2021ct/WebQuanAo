<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function viewCart()
    {
        return view('order.cart');
    }

    public function getFormCheckOut()
    {
        return view('order.checkOut');

    }

    public function completePayment()
    {
        return view('order.completePayment');
    }
}
