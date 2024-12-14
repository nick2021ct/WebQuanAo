<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['idUser', 'total', 'paymentMethod', 'status', 'pay'];
    public function user(){
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
    public function carts(){
        return $this->hasMany(Cart::class, 'idOrder', 'id');
    }
    public function voucher(){
        return $this->belongsTo(Voucher::class, 'idVoucher', 'id');
    }
    public function total(){
        return $this->total - $this
        ->voucher->value;
            
}
