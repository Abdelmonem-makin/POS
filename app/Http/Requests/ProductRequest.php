<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'photo'=>'required_without:id|mimes:jpg,png,jpeg',
            'name'=>'required|string|max:50',
            'discription'=>'required|max:5000',
            'price'=>'required',
            'categories_id'=>'required|exists:categories,id',

        ];
    }
    public function messages()
    {
        return [
            'required'=>'هذاء الحقل مطلوب',
            // 'required_without'=>'يجب تحميل الصوره',
            // 'name.string'=>'يجب ان يكون نص',
            // 'price.required'=>'يجب ان لا يزبد النص عن 100 حرف',
            'categories_id.exists'=>'موجود',
            // 'discription.required'=>'يجب كتابة الوصف   '


        ];
    }
}
