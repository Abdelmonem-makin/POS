<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales_return extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',         // رقم الفاتورة الأصلية
        'product_id',      // المنتج المسترجع
        'quantity',        // الكمية المسترجعة
        'price',           // سعر الوحدة
        'reason',          // سبب الاسترجاع
        'status',          // الحالة: restocked أو discarded
        'pharmacist_id',   // من نفذ العملية
    ];

    // 🔗 العلاقة مع الفاتورة الأصلية

    function order(){
        return $this->belongsTo(order::class, 'order_id');
    }
    // 🔗 العلاقة مع المنتج
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // 🔗 العلاقة مع الصيدلي (المستخدم)
    public function pharmacist()
    {
        return $this->belongsTo(User::class, 'pharmacist_id');
    }
}
