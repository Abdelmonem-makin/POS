<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class stock extends Model
{
    use HasFactory;
     protected $fillable = [
        'product_id','supplier_id','user_id','expir_data','TransactionType','price','Quantity'
    ];
    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function Supplier()
    {
        return $this->belongsTo(supplier::class, 'supplier_id', 'id');
    }
        public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
