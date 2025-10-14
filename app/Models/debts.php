<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class debts extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'stock_id',
        'amount',
        'invoice_number',
        'paid',
        'remaining',
        'due_date',
        'notes',
        'type',
        'is_closed'
    ];

    public function supplier()
    {
        return  $this->belongsTo(supplier::class, 'supplier_id', 'id');
    }
    function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id', 'id');
    }
}
