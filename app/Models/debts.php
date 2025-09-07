<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class debts extends Model
{
    use HasFactory;
       protected $fillable = [
        'supplier_id', 'amount', 'paid', 'remaining', 'due_date', 'notes'
    ];

    public function supplier()
    {
        return  $this->belongsTo(supplier::class, 'supplier_id', 'id');
    }
}
