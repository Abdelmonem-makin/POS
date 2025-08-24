<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\stock;
use App\Models\supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Stocks = stock::where(function ($q) use ($request) {
            return $q->when($request->filled('search'), function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->with('User')->latest()->paginate(5);
        return view('Dashboard.Stock.index', compact('Stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Products = Product::where('status', 1)->get();
        $suppliers = supplier::get();

        return view('Dashboard.Stock.create', compact('Products', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StockRequest $request)
    {
        // dd($request);
        // DB::beginTransaction();
        $Stocks = stock::create([
            'product_id' => $request->product_id,
            'supplier_id' => $request->Supplier_id,
            'user_id' => Auth::user()->id,
            'expir_data' => $request->expir_data,
            'TransactionType' => $request->TransactionType,
            'price' => $request->price,
            'Quantity' => $request->Quantity
        ]);
        $Products = Product::findOrFail($request->product_id);
        $r = $Products->Quantity + $request->Quantity;
        Product::where('id', $request->product_id)->update(['Quantity' => $r]);


        // DB::commit();
        return  redirect()->route('Stock.store')->with('success', 'تم الحفط بنجاح');
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
        $editID = stock::findOrFail($id);
        $Products = Product::where('status', 1)->get();
        $suppliers = supplier::get();
        return view('Dashboard.Stock.edit', compact('editID', 'suppliers', 'Products'));
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
        $stock = stock::find($id);
        if (!$stock) {
            return redirect()->route('stock.edite')->with(['error' => 'هذا العنصور غير موجود']);
        }
        $Stocks = stock::where('id', $id)->update([
            'product_id' => $request->product_id,
            'supplier_id' => $request->Supplier_id,
            'user_id' => Auth::user()->id,
            'expir_data' => $request->expir_data,
            'TransactionType' => $request->TransactionType,
            'price' => $request->price,
            'Quantity' => $request->Quantity
        ]);
        $Products = Product::findOrFail($request->product_id);

        if ($request->Quantity > $Products->Quantity) {
            $r = $Products->Quantity + $request->Quantity;
            
            Product::where('id', $request->product_id)->update(['Quantity' => $r]);
        }elseif ($request->Quantity < $Products->Quantity) {
             $r = $Products->Quantity + $request->Quantity;
            $totle = $Products->Quantity -$r ;
            Product::where('id', $request->product_id)->update(['Quantity' => abs($totle) ]);
        }




        // DB::commit();
        return  redirect()->route('Stock.index')->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resource = stock::findOrFail($id);
        $resource->delete();
        return redirect()->route('Stock.index')->with('success', 'Resource deleted successfully.');
    }
}
