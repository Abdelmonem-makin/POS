<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $fillable = [
       'name', 'user_id','start_time','end_time'
    ]; 
    public function orders()
    {
        return $this->hasMany(Order::class , 'shift_id' , 'id');
    }
     public function DailyRevenue()
    {
        return $this->hasMany(DailyRevenue::class, 'shift_id', 'id');
    }
    public function employee()
    {
        return $this->belongsTo(User::class , 'user_id', 'id');
    }
      public function expenses()
    {
        return $this->hasMany(expenses::class);
    }
}
