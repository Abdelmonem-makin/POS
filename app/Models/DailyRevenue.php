<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyRevenue extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_method_id',
        'employee_id',
        'shift_id',
        'profit',
        'revenue_date',
        'order_count',
        'total_net'
    ];
    public function employee()
    {
        return $this->belongsTo(User::class , 'employee_id', 'id') ;
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class , 'shift_id', 'id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(payment_methods::class , 'payment_method_id', 'id');
    }
}
