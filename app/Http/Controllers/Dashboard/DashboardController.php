<?php

namespace App\Http\Controllers\Dashboard;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function __construct()
    {
       
    }
    /**
     * Display the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Logic to get data for the dashboard
        return view('Dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
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
    public function store(Request $request)
    {
        // Validate and store the data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            // other validation rules
        ]);

        // Store the data
        // Model::create($validatedData);

        return redirect()->route('dashboard.index')->with('success', 'Resource created successfully.');
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
        // $resource = Model::findOrFail($id);

        return view('dashboard.show', compact('resource'));
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
        // $resource = Model::findOrFail($id);

        return view('dashboard.edit', compact('resource'));
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
        // $resource = Model::findOrFail($id);
        // $resource->update($validatedData);

        return redirect()->route('dashboard.index')->with('success', 'Resource updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Logic to delete the resource
        // $resource = Model::findOrFail($id);
        // $resource->delete();

        return redirect()->route('dashboard.index')->with('success', 'Resource deleted successfully.');
    }
}
