<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\debts;
use App\Models\supplier;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = supplier::with('debts')->get()->map(function ($supplier) {
            $total_amount = $supplier->debts->sum('amount');
            $total_paid = $supplier->debts->sum('paid');
            $total_remaining = $total_amount - $total_paid;

            return [
                'supplier' => $supplier,
                'total_amount' => $total_amount,
                'total_paid' => $total_paid,
                'total_remaining' => $total_remaining,
            ];
        }) ->filter(function ($data) {
            return $data['total_remaining'] > 0;
        });


        // $debts = debts::where(function ($q) use ($request) {
        //     return $q->when($request->search, function ($query) use ($request) {
        //         return $query->where('supplier_id', 'like', '%' . $request->search . '%');
        //     });
        // })->where('remaining', '>', 0)->with('supplier')->latest()->paginate(5);
        return view('Dashboard.debts.index', compact(  'suppliers'));
    }

    public function showDebts($customerId)
    {
        $supplier = supplier::findOrFail($customerId);

        // جلب كل ديون هذا العميل
        $debts = debts::where('supplier_id', $customerId)->where('remaining', '>', 0)->get();
        return view('Dashboard.debts.debts_show', compact( 'supplier', 'debts'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\debts  $debts
     * @return \Illuminate\Http\Response
     */
    public function show(debts $debts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\debts  $debts
     * @return \Illuminate\Http\Response
     */
    public function edit(debts $debts, $id)
    {
        $debts = debts::findOrFail($id);
        return view('Dashboard.debts.edit', compact('debts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\debts  $debts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, debts $debt )
    {
        $request->validate([
            'payment' => 'required|numeric|min:1'
        ]);

        // حساب المبلغ الجديد
        $debt->paid += $request->payment;
        $debt->remaining = $debt->amount - $debt->paid;

        // إغلاق الدين إذا انتهى
        if ($debt->remaining <= 0) {
            $debt->remaining = 0;
            $debt->is_closed = true;
        }

        $debt->save();

        return redirect()->route('debts.showDebts', $debt->supplier_id)->with('success', 'تمت تسوية المديونية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\debts  $debts
     * @return \Illuminate\Http\Response
     */
    public function destroy(debts $id)
    {
        $resource = debts::with('stock')->findOrFail($id);
        // foreach ($stock as $sorder) {
        //     $sorder->pivot->delete();
        //     //    dd($sorder);
        // }
        // $resource->delete();

        // $debts->stock->delete();
        return redirect()->route('debts.index')->with('success', '  تم الحذف لنجاح.');
    }
}
