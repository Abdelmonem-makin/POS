<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\debts;
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
        $debts = debts::where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('supplier_id', 'like', '%' . $request->search . '%');
            });
        })->where('remaining', '>', 0)->with('supplier')->latest()->paginate(5);
        return view('Dashboard.debts.index', compact('debts'));
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
    public function update(Request $request, debts $debt)
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

        return redirect()->route('debt.index')->with('success', 'تمت تسوية المديونية بنجاح');
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
