<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;
    protected $table = 'order_addresses';

    public function order()
    {
        return $this->belongsTo(Order::class, 'idOder', 'id'); 
    }
}
