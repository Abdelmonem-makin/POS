<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User_req;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:users_create'])->only('create');
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_update'])->only('edit');
        $this->middleware(['permission:users_delete'])->only('destroy');

    }
    public function index(Request $request)
    {
        $users = user::whereRoleIs('admin')->where(function ($q) use ($request) {
            return $q->when($request->search,function ($query) use ($request) {
                return $query->where('name','like','%'.$request->search.'%');
            });
        })->latest()->paginate(10);
        return view('Dashboard.Users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


       return view('Dashboard.Users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(User_req $data)
    {
        $request_data  = $data->except(['password' ,'password_confirmation','permissions']);
        $request_data['password'] = bcrypt($data->password);
        $user = User::create($request_data);
        $user->attachRole( $request_data['type']);
        $user->syncPermissions($data->permissions);
        return redirect()->route('User.create')->with(['success'=>'تم الحفظ بنجاح']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::select()->all();
        return view('Dashboard.Users.Edite', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Dashboard.Users.Edite', compact('user'));
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
        // try{

         $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],

    ]);
        // return $data ;
        $request_data  = $request->except('permissions');
        $resource = User::findOrFail($id);
        $resource->update($request_data);
        $resource->syncPermissions($request->permissions);

        return redirect()->route('User.edit',$id)->with('success', 'تم التحديث بنجاح.');

        //  } catch (\Exception $ex) {
        //     return redirect()->route('User.edit', $id)->with(['error'=>'يوجد خطاء الرجاء المحاوله']);
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
        $resource = User::findOrFail($id);
        $resource->delete();
        return redirect()->route('User.index')->with('success', 'Resource deleted successfully.');
    }
}
