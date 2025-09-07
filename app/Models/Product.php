<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Inventory;

class Product extends Model
{
    use HasFactory;
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    protected $fillable = [
        'id',
        'name',
        // 'photo',
        'descount',
        // 'discription',
        'add_by',
        // 'price',
        'sell_price',
        'Quantity',
        'status',
        'categories_id',
        'slug'
    ];

    public function Categorie()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }
    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }
    public function getStatus()
    {
        return $this->status == 1 ? 'مفعل' : 'غير مفعل';
    }
    function orders()
    {
        return $this->belongsToMany(order::class, 'product_order')->withPivot('quantity', 'sell_price');
    }

    function Stock()
    {
        return $this->belongsToMany(Stock::class, 'product_stocks')->withPivot('quantity', 'expir_data');
    }


    /**
     * آخر سجل جرد لهذا المنتج.
     *
     * نستخدم latestOfMany() للحصول على أحدث سجل (آخر إدخال) من
     * جدول inventories مرتبط بهذا المنتج. هذا يسهل بناء تقارير
     * الجرد باستخدام Eloquent بدلاً من استعلامات SQL المعقدة.
     */
    public function latestInventory()
    {
        return $this->hasOne(Inventory::class, 'product_id', 'id')->latestOfMany();
    }
}
