<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

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
    public function store(Request $request, Order $order)
    {

        $request->validate([
            'products' => 'required|array',
        ]);
        $total_price = 0;
        $code = 0;

        $order = Order::create([
            'total_price' => $total_price,
            'code' => $code,
            'name' => $request->name,
            'phone' => $request->phone,
            'tabel' => $request->tabel
        ]);
        $order->products()->attach($request->products);
        // dd($request->products);

        foreach ($request->products as $id => $quanities) {
            $product = Product::FindOrFail($id);

            $total_price += $product->price * $quanities['quantity'] ;
        }
        $code = $order->count()+1;

        $order->update([
            'total_price' => $total_price,
            'code' => $code

        ]);
        return redirect()->route('Home')->with('success', 'Resource deleted successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

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
    public function destroy(Order $order , $id)
    {
        $orders = Order::with('products')->findOrFail($id);
        $orders_pro = $orders->products;
        foreach ($orders_pro as $sorder) {
            $sorder->pivot->delete();
        //    dd($sorder);
        }
        $orders->delete();
        // dd('done');
        return redirect()->route('Order.index')->with('success', 'Resource deleted successfully.');
    }
}
