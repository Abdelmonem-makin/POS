<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;
    protected $fillable = [
         'name','phone','address','compane_name'
    ];
    public function Stock()
    {
        return $this->hasMany(Stock::class, 'product_id', 'id');
    }

}
