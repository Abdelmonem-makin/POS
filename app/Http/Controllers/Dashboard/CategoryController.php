<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\categoryReqiest;
use App\Models\Category;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Category_create'])->only('create');
        $this->middleware(['permission:Category_read'])->only('index');
        $this->middleware(['permission:Category_update'])->only('update');
        $this->middleware(['permission:Category_delete'])->only('destroy');
    }

    public function index(Request $request)
    {
        // Logic to get data for the dashboard
        $Categores = Category::where(function ($q) use ($request) {
            return $q->when($request->search,function ($query) use ($request) {
                return $query->where('name','like','%'.$request->search.'%');
            });

        })->latest()->paginate(5);
        return view('Dashboard.Category.index',compact('Categores'));
    }


    public function create()
    {
        return view('Dashboard.Category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(categoryReqiest $request)
    {

        // return $request;
        // Store the data
        $Category = Category::create([
            'name'  => $request->Name,
            'status'=> $request->status,
            ]);

        return  redirect()->route('Category.create')->with('success', 'تم الحفط بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Logic to get a specific resource
        $resource = Category::findOrFail($id);

        return view('Dashboard.Category.index', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Logic to get the resource to edit
        $resource = Category::findOrFail($id);

        return view('Dashboard.Category.EditeCatrgory', compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate and update the data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            // other validation rules
        ]);

        // Update the data
        $resource = Category::findOrFail($id);
        $resource->update($validatedData);
        return redirect()->route('Category.edit',$id)->with('success', 'تم التحديث بنجاح.');
    }

       function chaneg_Status(Request $request ,$id)  {

        // try {

            $id = $request->id;
            $Categorys = Category::findOrFail($id);
            $statusUpdate = $Categorys->status == 1 ? 0 : 1;
            $Categorys->update(['status'=>$statusUpdate]);
            return redirect()->route('Category.index');
        // } catch (\Exception $ex) {
        //     return redirect()->route('Category.index')->with(['error'=>'يوجد خطاء الرجاء المحاوله']);

        // }

    }



    public function destroy($id)
    {
        // Logic to delete the resource
        $resource = Category::findOrFail($id);
        $resource->delete();
        return redirect()->route('Category.index')->with('success', 'Resource deleted successfully.');
    }
}
