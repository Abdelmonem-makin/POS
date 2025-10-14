<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $fillable = [
        'total_price','user_id', 'invoice_number','name' ,'profit', 'phone','payment_id','shift_id'
    ];
    function products(){
    return $this->belongsToMany(product::class , 'product_order')->withPivot('quantity', 'sell_price');
    }
       public function paymentMethod()
    {
        return $this->belongsTo(payment_methods::class ,'payment_id' , 'id');
    }
    function shift() {
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }
    function sales_return(){
        return $this->hasMany(sales_return::class , 'order_id');
    }
}
