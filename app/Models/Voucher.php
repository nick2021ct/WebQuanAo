<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'dateStart',
        'dateEnd',
        'number',
        'value',
    ];

    public function voucher_detail()
    {
        return $this->hasMany(VoucherDetail::class,'idVoucher','id');
    }
}
