<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherDetail extends Model
{
    use HasFactory;
    protected $table = 'voucher_details';

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
    
    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'idVoucher','id');
    }
}
