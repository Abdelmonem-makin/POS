<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_number',
        'shift_id',
        'payment_method_id',
        'total_amount',
        'discount',
        'created_at',
    ];

    public function shift()
    {
        return $this->belongsTo(Shift::class ,'shift_id' , 'id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(payment_methods::class , 'payment_method_id' , 'id');
    }
}
