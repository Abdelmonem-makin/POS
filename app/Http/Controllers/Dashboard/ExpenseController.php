<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DailyRevenue;
use App\Models\expenses;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Expenses = expenses::where(function ($q) use ($request) {
            return $q->when($request->filled('search'), function ($query) use ($request) {
                return $query->where('title', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(5);
        return  view('Dashboard.Expenses.index', compact('Expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.Expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'amount' => 'required|numeric',
        ]);
        $request['user_id'] = Auth::user()->id;
        $request['expense_date'] = Carbon::today();
        expenses::create($request->all());
        return redirect()->back()->with('success', 'تم تسجيل المصروف بنجاح');
    }
    public function empExpenses(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'amount' => 'required|numeric',
        ]);
        $request['user_id'] = Auth::user()->id;
        $request['expense_date'] = Carbon::today();
        $expenses = expenses::create($request->all());
        $shift = Shift::where('user_id', auth()->id())->first();
        $today = Carbon::today();
        // تحديث أو إنشاء الإيراد اليومي
        $revenue = DailyRevenue::firstOrNew([
            'shift_id' => $shift->user_id,
            'payment_method_id' =>1,
            'employee_id' => Auth::user()->id,
            'revenue_date' => $expenses->expense_date,
        ]);
        $revenue->total_expenses = ($revenue->total_net ?? 0) + $expenses->amount;
        // توليد رقم الإيراد إذا جديد
        if (!$revenue->exists) {
            $revenue->revenue_number = 'REV-' . str_pad(DailyRevenue::count() + 1, 5, '0', STR_PAD_LEFT);
        }
        $revenue->save();

        return redirect()->back()->with('success', 'تم تسجيل المصروف بنجاح');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
