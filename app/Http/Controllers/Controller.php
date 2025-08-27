<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Category;
use App\Models\payment_methods;
use App\Models\Shift;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function __construct() {}
    public function index(Request $request)
    {

        $Categorys = Category::where('status', 1)->whereHas('Product', function ($query) {
            $query->where('status', 1);
        })->with(['Product' => function ($query) {
            $query->where('status', 1);
        }])->get();
        $payment_methods = payment_methods::get();

        // }حل مشكلة حتي تقوم بالغاء تفعل منتج يجب ان تلغي جمبع المنتجات
        // هو ان اسم المتغير الموجود في
        // حلقة الداخايه متشابه مع المتغير الحلقه الداخيليه
        return view('Dashboard.home', compact('Categorys', 'payment_methods'));
    }



    // public function getTodayShiftInvoices($shiftName)
    // {
    //     $today = Carbon::today();

    //     $shift = Shift::with([
    //         'employee',
    //         'orders.paymentMethod',
    //         'orders.product'
    //     ])
    //         ->where('name', $shiftName)
    //         ->whereDate('shift_date', $today)
    //         ->first();

    //     if (!$shift) {
    //         return response()->json(['message' => 'لا توجد وردية بهذا الاسم اليوم'], 404);
    //     }

    //     $invoices = $shift->orders->map(function ($invoice) {
    //         return [
    //             'invoice_number' => $invoice->invoice_number,
    //             'payment_method' => $invoice->paymentMethod->method_name,
    //             // 'created_at' => $invoice->created_at->format('H:i'),
    //             'total' => $invoice->total_price,

    //             // 'transaction' => $invoice->transaction ? [
    //             //     'number' => $invoice->transaction->transaction_number,
    //             //     'bank' => $invoice->transaction->bank_name,
    //             //     'time' => $invoice->transaction->transaction_date->format('H:i')
    //             // ] : null,
    //             // 'products' => $invoice->products->map(function ($product) {
    //             //     return [
    //             //         'name' => $product->name,
    //             //         'quantity' => $product->pivot->quantity,
    //             //         'price' => $product->price,
    //             //     ];
    //             // })
    //         ];
    //     });

    //     return response()->json([
    //         'shift' => [
    //             'name' => $shift->name,
    //             'date' => $shift->shift_date->format('Y-m-d'),
    //             'employee' => $shift->employee->name
    //         ],
    //         'invoices' => $invoices
    //     ]);
    // }
}
