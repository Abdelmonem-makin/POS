<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment_methods extends Model
{
    use HasFactory;
    protected $fillable = [
        'method_name',

    ];
    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
    public function DailyRevenue()
    {
        return $this->hasMany(DailyRevenue::class, 'payment_method_id', 'id');
    }
    public function stock()
    {
        return $this->hasMany(stock::class, 'payment_id', 'id');
    }
}
