<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockRequest;
use App\Models\Category;
use App\Models\debts;
use App\Models\payment_methods;
use App\Models\Product;
use App\Models\stock;
use App\Models\supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{

    public function index(Request $request)
    {
        $Stocks = stock::where(function ($q) use ($request) {
            return $q->when($request->filled('search'), function ($query) use ($request) {
                return $query->where('product_id', 'like', '%' . $request->search . '%');
            });
        })->with('User', 'Product', 'debt')->latest()->paginate(5);
        return view('Dashboard.Stock.index', compact('Stocks'));
    }

    public function create(Request $request)
    {
        $payment_methods = payment_methods::get();

        $Products = Product::where('status', 1)->get();
        $suppliers = supplier::get();
        $Products = Product::where(function ($q) use ($request) {
            return $q->when($request->filled('search'), function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->get();
        return view('Dashboard.Stock.create', compact('Products', 'suppliers', 'payment_methods', 'Products'));
    }


    public function store(StockRequest $request)
    {
        // dd($request->all());
        // try {
        $validator = Validator::make($request->all(), []);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'خطأ في بيانات الطلب', 'errors' => $validator->errors()], 422);
        }

        DB::transaction(function () use ($request) {
            // إنشاء الفاتورة
            $lastInvoice = stock::orderBy('id', 'desc')->first();
            $nextId = $lastInvoice ? $lastInvoice->id + 1 : 1;
            $invoice_number = 'INVBUY-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
            $stock = stock::create([
                'supplier_id' => $request->Supplier_id,
                'invoice_number' => $invoice_number,
                'payment_id' => $request->payment_id,
                'transiction_no' => $request->transiction_no,
                'user_id' => Auth::user()->id,
                'total_price' => $request->total_price,
            ]);
            $attachData = [];

            // إضافة تفاصيل المنتجات إلى الفاتورة
            foreach ($request->products_stock as $id => $product) {
                $stock->Product()->attach($id, [
                    'quantity' => $product['quantity'],
                    'expir_data' => $product['expir_data'],

                ]);
                $Products = Product::findOrFail($id);
                $r = $Products->Quantity +  $product['quantity'];
                Product::where('id', $id)->update(['Quantity' => $r]);
                // 🔹 تسجيل المديونية إذا كان الدفع جزئي
                if ($request->paid_amount < $stock->total_price) {
                    $debts = debts::create([
                        'supplier_id' => $request->Supplier_id,
                        'invoice_number' => $invoice_number,
                        'stock_id' => $stock->id,
                        'due_date' => '2022-1-1',
                        'amount' => $stock->total_price,
                        'paid' => $request->paid_amount,
                        'type' => 'supplier',
                        'remaining' => $stock->total_price - $request->paid_amount,
                        'notes' => 'فاتورة شراء رقم ' . $stock->invoice_number,
                        'is_closed' => false
                    ]);
                }
            }
        });
        return  redirect()->route('Stock.create')->with('success', 'تم الحفط بنجاح');
        // } catch (\Throwable $th) {
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment_methods = payment_methods::get();

        $stock = Stock::with('Product', 'debt')->findOrFail($id);

        $allProducts = $stock->Product; // لعرض كل المنتجات للاختيار منها

        if (!$stock) {
            return redirect()->route('stock.index')->with(['error' => 'هذا العنصور غير موجود']);
        }
        $Products = Product::where('status', 1)->get();
        $suppliers = supplier::get();
        return view('Dashboard.Stock.edit', compact('payment_methods', 'stock', 'allProducts', 'suppliers', 'Products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $stock = Stock::with('Product', 'debt')->findOrFail($id);
        $stock->update([
            'supplier_id' => $request->supplier_id,
            'payment_id' => $request->payment_id,
            'transiction_no' => $request->transiction_no,
            'user_id' => Auth::id(),
            'total_price' => $request->total_price,
        ]);
        $productData = [];
        foreach ($request->products_stock as $productId => $data) {
            if (!empty($data['quantity']) && !empty($data['expir_data'])) {
                $productData[$productId] = [
                    'quantity' => $data['quantity'],
                    'expir_data' => $data['expir_data'],
                ];
            }
            // المنتج الحالي
            $product = Product::findOrFail($productId);

            // الكمية الحالية في جدول المنتجات
            $currentQuantity = $product->Quantity;

            // الكمية السابقة التي كانت مضافة في جدول pivot
            $previousPivot = $stock->Product->find($productId)?->pivot;
            $oldAddedQuantity = $previousPivot?->quantity ?? 0;

            // الكمية الجديدة التي يريد المستخدم إضافتها
            $newAddedQuantity = $data['quantity'];

            // الفرق بين القديم والجديد
            $difference = $newAddedQuantity - $oldAddedQuantity;

            // الشرط الثلاثي
            if ($difference > 0) {
                // إضافة الفرق
                $product->update(['Quantity' => $currentQuantity + $difference]);
            } elseif ($difference < 0) {
                // خصم الفرق
                $product->update(['Quantity' => max(0, $currentQuantity + $difference)]);
            }
        }
        $stock->Product()->sync($productData);
        // تحديث أو إنشاء المديونية
        if ($request->paid < $stock->total_price) {
            debts::updateOrCreate(
                ['supplier_id' => $request->supplier_id, 'stock_id' => $stock->id],
                [
                    'amount' => $stock->total_price,
                    'paid' => $request->paid,
                    'remaining' => $stock->total_price - $request->paid,
                    'due_date' => '2022-01-01',
                    'is_closed' => false,
                ]
            );
        }

        return redirect()->back()->with('success', 'تم التعديل بنجاح');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resource = stock::with('Product')->findOrFail($id);
        $stock =  $resource->Product;
        foreach ($stock as $id => $sorder) {
            $sorder->pivot->delete();
            $Products = Product::find($id);
            $r = $Products->Quantity +  $sorder->pivot->quantity ;
            Product::where('id', $id)->update(['Quantity' => $r]);
        }
        $resource->delete();

        return redirect()->route('Stock.index')->with('success', '  تم الحذف لنجاح.');
    }
}
