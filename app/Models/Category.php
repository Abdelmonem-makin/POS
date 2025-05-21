<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\CategoryObserver;

class Category extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $fillable = [
        'name',
        'status',

    ];

    protected static function boot(){
        parent::boot();
        Category::observe(CategoryObserver::class);
    }
    public function scopeStatus($query){
        return $query->where('status',1);
    }
    public function getStatus(){
        return $this -> status == 1 ? 'مفعل' : 'غير مفعل';
    }

    public function Product(){
        return $this->hasMany(Product::class,'categories_id','id');
     }
}
