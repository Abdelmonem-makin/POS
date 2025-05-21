<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use HasFactory;
    protected $guarded=[];

    protected $fillable = [
        'id','name','photo','descount','discription','add_by','price','status','categories_id','slug'
    ];

    public function Categorie(){
        return $this->belongsTo(Category::class,'categories_id','id');
    }
    public function scopeStatus($query){
        return $query->where('status',1);
    }
    public function getStatus(){
        return $this -> status == 1 ? 'مفعل' : 'غير مفعل';
    }
    function orders(){
        return $this->belongsToMany(order::class ,'product_order');
    }
}
