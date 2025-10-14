<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DailyRevenue;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Product;
use App\Models\sales_return;
use App\Models\stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class returnBayController extends Controller
{
    function index(Request $request)
    {
        $orders = Order::where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->where('user_id', Auth::user()->id)->with('products')->latest()->paginate(5);
        return view('Dashboard.returnBay.return', compact('orders'));
    }
    function show($id)
    {

        $order = Order::with('products')->findOrFail($id);
        $Products = $order->products;
        return view('Dashboard.returnBay.returnback', compact('order', 'Products'));
    }
    function sales_return(){
        $returns = sales_return::with('product','pharmacist' ,'order')->latest()->paginate(5);
        return view('Dashboard.returnBay.index', compact('returns'));
    }
    public function store(Request $request)
    {
        // return $request;
        $product = Product::where('id', $request->product_id)->first();

        $request->validate([
            'sale_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string',
            'status' => 'required|in:restocked,discarded',
        ]);

        $return = sales_return::create([
            'order_id' => $request->sale_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $product->sell_price,
            'reason' => $request->reason,
            'status' => $request->status,
            'pharmacist_id' => auth()->id(),
        ]);

        $order = Order::with('products')->find($request->sale_id);
        // $products = $order->products;

        // تحديث الجرد إذا أعيد للمخزون
        if ($request->status === 'restocked') {
            // stock::where('product_id', $request->product_id)
            //     ->increment('quantity', $request->quantity);
            $order->decrement('total_price', $request->quantity * $product->sell_price);
            // $order->products->updateExistingPivot($request->product_id, [
            //     'quantity' => DB::raw('quantity + ' . $request->quantity)
            // ]);
            // تحديث كمية المنتج في جدول المنتجات
            if ($product) {
                $product->increment('Quantity', $request->quantity);
                $order->products()->detach($request->product_id);
            }
            if ($order->products->count() == 0) {
                $order->delete();
            }
        }
        // خصم من الإيرادات
        $today = Carbon::today();
        // تحديث أو إنشاء الإيراد اليومي
        $revenue = DailyRevenue::firstOrNew([
            'shift_id' => $order->shift_id,
            'employee_id' => $order->shift->user_id,
            'payment_method_id' => $order->payment_id,
            'revenue_date' => $today,
        ]);
        $revenue->decrement('total_net', $request->quantity * $request->price);
        $revenue->save();

        return redirect()->route('show-return', $order->id)->with('success', 'تم تسجيل مردود المبيعات بنجاح');
    }
}
