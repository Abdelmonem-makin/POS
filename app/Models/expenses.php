<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class expenses extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'amount',
        'expense_date',
        'category',
        'user_id', // أضف هذا الحقل
    ];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'decimal:2',
    ];

    // علاقة المصروف بالمستخدم
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
