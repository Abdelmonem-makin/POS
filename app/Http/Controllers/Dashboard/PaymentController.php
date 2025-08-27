<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\payment_methods;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Payments = payment_methods::where(function ($q) use ($request) {
            return $q->when($request->filled('search'), function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(5);
        return  view('Dashboard.Payment.index', compact('Payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.Payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $PaymentRequest)
    {
        $dataRequest = $PaymentRequest->validated();
        payment_methods::create($dataRequest);

        return redirect()->route('Payment.index')->with('success', __('trans.Category_Saved'));
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
        $Payment = payment_methods::findOrFail($id);

        return view('Dashboard.Payment.edit', compact('Payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentRequest $PaymentRequest, $id)
    {
        $Payment = payment_methods::find($id);
        if (!$Payment) {
            return redirect()->route('stock.edite' ,$Payment->id)->with(['error' => 'هذا العنصور غير موجود']);
        }
        $dataRequest = $PaymentRequest->validated();
        payment_methods::where('id', $id)->update($dataRequest);

        return redirect()->route('Payment.edit' ,$Payment->id)->with('success', __('trans.Category_edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resource = payment_methods::findOrFail($id);
        $resource->delete();

        return redirect()->route('Payment.index')->with('success', __('trans.Category_deleted'));
    }
}
