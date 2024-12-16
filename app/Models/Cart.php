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

}
