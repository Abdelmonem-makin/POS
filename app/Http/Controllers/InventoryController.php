<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $months =  Inventory::selectRaw('DATE_FORMAT(inventory_date, "%Y-%m-01") as month')
            ->distinct()
            ->orderBy('month', 'desc')
            ->get()
            ->map(function ($item) {
                return Carbon::parse($item->month);
            });

    $Product = Product::with('Categorie')->orderBy('name')->get();
        // $inventories = Inventory::with('product', 'user')->latest()->paginate(20);
        return view('Dashboard.inventory.index', compact('months'));
    }
    public function create()
    {
    $Product = Product::with('Categorie')->get();
        // $Product = Product::all();
        return view('Dashboard.inventory.create', compact('Product'));
    }
    public function store(Request $request)
    {
        foreach ($request->actual_quantity as $productId => $actualQty) {
            $product = Product::find($productId);
            // return $product;
            $request->validate([
                'actual_quantity' => 'required|array',
                'actual_quantity.*' => 'required|integer|min:0',
            ]);
            Inventory::create([
                'product_id' => $productId,
                'system_quantity' => $product->Quantity,
                'actual_quantity' => $actualQty,
                'cost_price' => $product->sell_price,
                'inventory_date' => now(),
                'user_id' => auth()->id(),
            ]);
        }

        return redirect()->back()->with('success', 'تم حفظ الجرد الشهري بنجاح');
    }

    /**
     * Show inventory difference report: system quantity vs last counted quantity.
     *
     * هذا الميثود يبني تقريرًا يقارن بين الكمية المسجلة في جدول المنتجات
     * وآخر كمية تم إدخالها في جدول الجرد لكل منتج. كما يحسب قيمة الفرق
     * والأثر على الربح بناءً على سعر البيع وسعر التكلفة.
     *
     * الحقول المخرجة في التقرير:
     * - id, name
     * - system_qty: الكمية المسجلة في النظام (products.Quantity)
     * - counted_qty: آخر كمية تم جردها من جدول inventories
     * - diff: (counted_qty - system_qty)
     * - value_diff: قيمة الفرق مضروبة في سعر البيع (تأثير على الإيراد الظاهر)
     * - profit_per_unit: هامش الربح للوحدة = sell_price - price
     * - profit_diff: أثر الفرق على الربح = diff * profit_per_unit
     */
    public function report(Request $request)
    {
        $month = $request->input('month')
            ? Carbon::parse($request->month)->startOfMonth()
            : Carbon::now()->startOfMonth();

        // جلب بيانات الجرد من قاعدة البيانات
        $inventories = Inventory::with(['product', 'user'])
            ->whereMonth('inventory_date', $month->month)
            ->whereYear('inventory_date', $month->year)
            ->get()
            ->map(function ($item) {
                $difference = $item->actual_quantity - $item->system_quantity;
                $totalDifference = $difference * $item->cost_price;

                return [
                    'product_name' => $item->product->name,
                    'system_quantity' => $item->system_quantity,
                    'actual_quantity' => $item->actual_quantity,
                    'cost_price' => $item->cost_price*$item->actual_quantity,
                    'difference' => $difference,
                    'total_difference' => $totalDifference,
                    'inventory_date' => $item->inventory_date,
                    'user_id' => $item->user->name,
                ];
            });
        // حساب الإجماليات
        $total_system_qty = $inventories->sum('system_quantity');
        $total_counted_qty = $inventories->sum('actual_quantity');
        $total_base = $inventories->sum('cost_price');

        $total_system_value = $inventories->sum(function ($item) {
            return $item['system_quantity']  * $item['cost_price'];
        });

        $total_counted_value = $inventories->sum(function ($item) {
            return$item['actual_quantity'] * $item['cost_price'];
        });

        $total_profit_diff = $total_counted_value - $total_system_value;


        // إرسال البيانات إلى واجهة العرض
        return view('Dashboard.inventory.report', [
            'inventories' => $inventories,
            'month' => $month->translatedFormat('F Y'),
            'total_system_qty' => $total_system_qty,
            'total_counted_value' => $total_counted_value,
            'total_base' => $total_base,
            'total_system_value' => $total_system_value,
            'total_profit_diff' => $total_profit_diff,

            'month' => $month->translatedFormat('F Y'),
        ]);
    }
}
