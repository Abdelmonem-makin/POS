<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $Products = Product::where(function ($q) use ($request) {
            return $q->when($request->filled('search'), function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(5);
        return view('Dashboard.Prodect.Index', compact('Products'));
    }

    public function create()
    {
        $Categorys = Category::where('status', 1)->get();

        return view('Dashboard.Prodect.create', compact('Categorys'));
    }

    public function store(ProductRequest $request)
    {
        $photoPath = "";
        if ($request->has('photo')) {
            $photoPath = uploadImage('product', $request->photo);
        }
        $slug =  Str::slug($request->name);

        $productID = Product::create([
            'slug' => $slug,
            'name' => $request->name,
            'discription' => $request->discription,
            'categories_id' => $request->categories_id,
            'photo' => $photoPath,
            'price' => $request->price,
            'add_by' => 'Admin',
            'status' => $request->status,
        ]);
        return  redirect()->route('Product.create')->with('success', 'تم الحفط بنجاح');
    }



    function chaneg_Status(Request $request, $id)
    {

        try {

            $id = $request->id;
            $Products = Product::findOrFail($id);
            $statusUpdate = $Products->status == 1 ?  0 : 1;
            $Products->update(['status' => $statusUpdate]);
            return redirect()->route('Product.index');
        } catch (\Exception $ex) {
            return redirect()->route('Product.index')->with(['error' => 'يوجد خطاء الرجاء المحاوله']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editID = Product::findOrFail($id);
        $Categorys = Category::where('status', 1)->get();
        return view('Dashboard.Prodect.Edite', compact('editID', 'Categorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        // try{
        DB::beginTransaction();
        // return $request;
        $id = $request->Product;
        $Product = Product::find($id);
        if (!$Product) {
            return redirect()->route('Product.edite')->with(['error' => 'هذا العنصور غير موجود']);
        }
        //cheack status if is on or off
        if (!$request->has('status')) {
            $request->request->add(['status' => 0]);
        } else {
            $request->request->add(['status' => 1]);
        }
        //get array of requset
        Product::where('id', $id)->update([
            'name' => $request->name,
            'categories_id' => $request->categories_id,
            'price' => $request->price,
            'discription' => $request->discription,
            'status' => $request->status,
        ]);
        //add new photo if uploud one
        // $photoPath =$photoPath;
        if ($request->has('photo')) {
            $photoPath = uploadImage('product', $request->photo);
            Product::where('id', $id)->update(['photo' => $photoPath]);
        }

        DB::commit();
        return redirect()->route('Product.index')->with(['success' => 'تم التحديث بنجاح']);
        // } catch (\Exception $ex) {
        //     return redirect()->route('Product.edit',['Product'=>$id])->with(['error'=>'يوجد خطاء الرجاء المحاوله']);
        // }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resource = Product::findOrFail($id);
        $resource->Stock()->delete();
        $resource->delete();
        return redirect()->route('Product.index')->with('error',  'تم الحذف بنجاح');

    }
}
