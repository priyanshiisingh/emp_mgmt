<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $departments = Department::all();
        return view('frontend.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('frontend.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        // Create a new Department record
        Department::create($request->all());

        // Redirect to the index page with a success message
        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $department = Department::find($id);
        return view('frontend.departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $department = Department::find($id);
        return view('frontend.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'status' => 'required|in:active,inactive',
        ]);
    
        $department = Department::find($id);

    
        $department->update($request->all());
    
        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::find($id);

        if (!$department) {
            return redirect()->route('departments.index')
                ->with('error', 'Department not found.');
        }
    
        $department->delete();
    
        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}
