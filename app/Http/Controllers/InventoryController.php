<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $Product = Product::orderBy('name')->get();

        $inventories = Inventory::with('product','user')->latest()->paginate(20);
        return view('Dashboard.inventory.index', compact('inventories' ,'Product'));
    }

    public function create()
    {
        $products = Category::all();
        return view('Dashboard.inventory.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
        ]);

        $data['user_id'] = auth()->id();

        Inventory::create($data);

        return redirect()->route('inventory.index')->with('success', 'تم إنشاء جرد بنجاح');
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
    public function report()
    {
        // نستخدم Eloquent: نحمّل كل المنتجات مع آخر سجل جرد لها (إن وجد)
        $products = Product::with('latestInventory')->orderBy('id')->get();

        // نحول كل منتج إلى صف تقرير يحتوي الحقول المطلوبة
        $report = $products->map(function ($p) {
            $counted = $p->latestInventory?->quantity ?? 0;
            $countedAt = $p->latestInventory?->created_at ?? null;
            $systemQty = (int) $p->Quantity;
            $diff = $counted - $systemQty; // counted - system
            $sell = (float) $p->sell_price;
            $cost = (float) $p->price;
            $valueDiff = $diff * $sell; // قيمة الفرق بحسب سعر البيع
            $base = $counted * $sell; //راس المال داخل الصيدليه
            // $profitPerUnit = $sell - $cost; // هامش الربح
            $profitDiff = $diff * $sell; // إجمالي أثر الفرق على الربح

            return (object) [
                'id' => $p->id,
                'name' => $p->name,
                'system_qty' => $systemQty,
                'counted_qty' => $counted,
                'counted_at' => $countedAt,
                'sell_price' => $sell,
                'cost_price' => $cost,
                'diff' => $diff,
                'base' => $base,
                'value_diff' => $valueDiff,
                // 'profit_per_unit' => $profitPerUnit,
                'profit_diff' => $profitDiff,
            ];
        });

        // حساب مجاميع التقرير لتعرض في الواجهة (كمية، قيمة، ربح)
        $total_system_qty = $report->sum('system_qty');
        $total_counted_qty = $report->sum('counted_qty');
        $total_base = $report->sum('base');
        $total_system_value = $report->sum(function ($r) {
            return $r->system_qty * $r->sell_price;
        });
        $total_counted_value = $report->sum(function ($r) {
            return $r->counted_qty * $r->sell_price;
        });
        $total_value_diff = $report->sum('value_diff');
        $total_profit_diff = $report->sum('profit_diff');

        return view('Dashboard.inventory.report', compact(
            'report',
            'total_system_qty',
            'total_counted_qty',
            'total_system_value',
            'total_counted_value',
            'total_value_diff',
            'total_profit_diff',
            'total_base'
        ));
    }
}
