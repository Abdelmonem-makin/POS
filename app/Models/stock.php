<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'total_price',
        'supplier_id',
        'user_id',
        'transiction_no',
        'payment_id',
        'invoice_number'
    ];
    public function Product()
    {
        return $this->belongsToMany(product::class, 'product_stocks')->withPivot('quantity', 'expir_data');
    }
    public function Supplier()
    {
        return $this->belongsTo(supplier::class, 'supplier_id', 'id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function payment()
    {
        return $this->belongsTo(payment_methods::class, 'payment_id', 'id');
    }
}
