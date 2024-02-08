<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $employees = Employee::all();
        return view('frontend.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('frontend.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|numeric', // Assuming phone is numeric, adjust if needed
            'profile_image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
            'department' => 'nullable',
        ]);

        // Handle profile_image upload
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filePath = $file->store('profile_images', 'public');
            $request->merge(['profile_image' => $filePath]);
        }

        // Create a new employee record
        Employee::create($request->all());

        // Redirect to the index page with a success message
        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $employee = Employee::find($id);
        return view('frontend.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $employee = Employee::find($id);
        return view('frontend.employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'phone' => 'nullable|numeric',
            'profile_image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
            'department' => 'nullable',
        ]);
    
        $employee = Employee::find($id);
    
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('profile_images', $fileName, 'public');
            $request->merge(['profile_image' => $fileName]);
        }
    
        $employee->update($request->all());
    
        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return redirect()->route('employees.index')
                ->with('error', 'Employee not found.');
        }
    
        $employee->delete();
    
        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
