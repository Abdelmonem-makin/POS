<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
           [
                'transiction_no' => '',
                'payment_id' => 'required|exists:payment_methods,id',
                'products' => 'required|array|min:1',
                'products.*.quantity' => 'required|integer|min:1',
            ], [
                'payment_id.required' => 'اختر طريقة الدفع',
                'products.required' => 'لا توجد منتجات في الطلب',
                'products.*.quantity.required' => 'الكمية مطلوبة لكل منتج',
            ]
        ];
    }
}
