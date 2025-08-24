<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $fillable = [
        'total_price', 'order_number','name' , 'phone', 'tabel'
    ];
    function products(){
        return $this->belongsToMany(product::class , 'product_order')->withPivot('quantity');
    }
}
