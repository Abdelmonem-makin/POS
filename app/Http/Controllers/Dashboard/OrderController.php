<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\DailyRevenue;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->with('products')->latest()->paginate(5);
        return view('Dashboard.Order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    function Order_incame(Request $request)
    {
        // $orders = Order::where(function ($q) use ($request) {
        //     return $q->when($request->search, function ($query) use ($request) {
        //         return $query->where('name', 'like', '%' . $request->search . '%');
        //     });
        // })->with('products')->latest()->paginate(5);
        // return view('Dashboard.Order.incame', compact('orders'));
        $revenues1 = DailyRevenue::with(['employee', 'shift', 'paymentMethod'])
            ->orderBy('revenue_date', 'desc')
            ->get()
            ->groupBy('shift_id');

        $revenues = $revenues1->map(function ($group) {
            $first = $group->first();
            // $profit = $group->sum('profit');
            $cash = $group->where('payment_method_id', 1)->sum('total_net');
            $bank = $group->where('payment_method_id', 2)->sum('total_net');

            return [
                'order_count' => $first->order_count,
                'shift_name' => $first->shift->name,
                'employee_name' => $first->employee->name,
                'revenue_date' => $first->revenue_date,
                'cash_total' => $cash,
                'bank_total' => $bank,
                // 'profit' => $profit,
                'total_revenue' => $cash + $bank
            ];
        })->values();

        return view('Dashboard.Order.incame', compact('revenues'));
    }
    public function show_product_order(Order $order, $id)
    {
        $orders = Order::with('products')->find($id);
        $orders_pro = $orders->products;
        // dd($orders_pro);
        return view('Dashboard.Order.porduct_show', compact('orders_pro', 'orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request, Order $order)
    {
        try {
            $validator = Validator::make($request->all(),[]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => 'خطأ في بيانات الطلب', 'errors' => $validator->errors()], 422);
            }

            DB::beginTransaction();

            $total_price = 0;
            $totalprofit = 0;
            $lastInvoice = Order::orderBy('id', 'desc')->first();
            $nextId = $lastInvoice ? $lastInvoice->id + 1 : 1;
            $invoiceNumber = 'INV-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
            $shift = Shift::where('user_id', auth()->id())->first();

            $order = Order::create([
                'invoice_number' => $invoiceNumber,
                'payment_id' => $request->payment_id,
                'shift_id' => $shift->id,
                'total_price' => $total_price,
                'transiction_no' => $request->transiction_no,
            ]);

            // Attach products with explicit pivot data (quantity and sell_price)
            $attachData = [];
            foreach ($request->products as $id => $quantities) {
                $product = Product::findOrFail($id);

                // validate available stock
                if ($product->Quantity < $quantities['quantity']) {
                    DB::rollBack();
                    return response()->json(['error' => false, 'message' => "الكمية المتاحة من المنتج {$product->name} أقل من المطلوب"], 422);
                }

                $lineTotal = $product->sell_price * $quantities['quantity'];
                $total_price += $lineTotal;
                $profit = $product->sell_price - $product->price;
                $totalprofit += $profit * $quantities['quantity'];
                $attachData[$id] = [
                    'quantity' => $quantities['quantity'],
                    'sell_price' => $product->sell_price ,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // decrement stock
                $product->decrement('Quantity', $quantities['quantity']);
            }

            $order->products()->attach($attachData);

            $code = Order::count() + 1;
            $order->update([
                'total_price' => $total_price,
            ]);

            $today = Carbon::today();
            // تحديث أو إنشاء الإيراد اليومي
            $revenue = DailyRevenue::firstOrNew([
                'shift_id' => $order->shift_id,
                'employee_id' => $order->shift->user_id,
                'payment_method_id' => $order->payment_id,
                'revenue_date' => $today,
            ]);

            $revenue->order_count = ($revenue->order_count ?? 0) + 1;
            $revenue->total_net = ($revenue->total_net ?? 0) + $total_price;
            $revenue->profit = ($revenue->profit ?? 0) + $totalprofit;


            // توليد رقم الإيراد إذا جديد
            if (!$revenue->exists) {
                $revenue->revenue_number = 'REV-' . str_pad(DailyRevenue::count() + 1, 5, '0', STR_PAD_LEFT);
            }

            $revenue->save();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'تم الشراء بنجاح']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => false, 'message' => 'حدث خطأ أثناء إنشاء الطلب', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order, $id)
    {
        $orders = Order::with('products')->findOrFail($id);
        $orders_pro = $orders->products;
        foreach ($orders_pro as $sorder) {
            $sorder->pivot->delete();
               dd($sorder);
        }
        $orders->delete();
        // dd('done');
        return redirect()->route('Order.index')->with('success', 'تم الحذف بنجاح');
    }
}
