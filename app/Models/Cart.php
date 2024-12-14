<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'idProduct',
        'qty',
        'size',
        'idUser',
        'idOrder',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'idProduct', 'id');
    }
public function user(){
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
    public function order(){
        return $this->belongsTo(Order::class, 'idOrder', 'id');
    }
    public function size(){
        return $this->belongsTo(Size::class, 'size', 'size');
    }
        public function total(){
        return $this->qty * $this->product->priceSale;
    }
        public function totalCart(){
        return $this->qty * $this->product->priceSale;
    }
}
