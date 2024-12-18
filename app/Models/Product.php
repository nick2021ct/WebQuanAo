<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'price',
        'priceSale',
        'gender',
        'description',
        'view',
        'idCategory',
        'idBrand',
    ];
    
    public function brand(){
        return $this->belongsTo(Brand::class, 'idBrand', 'id')->withTrashed();
    }
    public function category(){
        return $this->belongsTo(Category::class, 'idCategory', 'id')->withTrashed();
    }
    public function size(){
        return $this->belongsTo(Size::class, 'id', 'idProduct');
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'idProduct');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'idProduct', 'id');
    }

    public function averageRating()
    {
        $totalRating = $this->comments->sum('rating');
        $numberOfComments = $this->comments->count();

        if ($numberOfComments > 0) {
            return $totalRating / $numberOfComments;
        }

        return 0;
    }
}