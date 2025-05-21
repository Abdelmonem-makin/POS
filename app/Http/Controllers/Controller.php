<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Category;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {
      
    }
    public function index(Request $request){

        $Categorys = Category::where('status',1)->whereHas('Product',function ($query) {
              $query->where('status',1);
         })->with(['Product'=>function ($query) {
              $query->where('status',1);
         }])->get();

        // }حل مشكلة حتي تقوم بالغاء تفعل منتج يجب ان تلغي جمبع المنتجات
        // هو ان اسم المتغير الموجود في
        // حلقة الداخايه متشابه مع المتغير الحلقه الداخيليه
        return view('Dashboard.home',compact('Categorys'));
    }
}

