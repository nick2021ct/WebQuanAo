<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=[
        'rating',
        'content',
        'idUser',
        'idProduct'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'idProduct', 'id');
    }
}