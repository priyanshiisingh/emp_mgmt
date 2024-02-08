<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();

        // Fetch employees based on the user's role
        if ($user->name === 'super_admin') {
            $employees = Employee::all();
        } else {
            $employees = Employee::where('id', auth()->id())->get();
        }
        return view('frontend.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        // Fetch employees based on the user's role
        if ($user->name === 'super_admin') {
        return view('frontend.employees.create');
        }else {
            abort(403, 'Unauthorized action.');
        }
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
        $employee = Employee::create($request->all());

        // Create a user for the employee
        $user = User::create([
            'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt('default_password'), // You should set a default password or send a notification for setting the password
        ]);

        // Associate the user with the employee
        $employee->user()->associate($user);
        $employee->save();


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
    public function edit(Employee $employee)
    {
        $user = Auth::user();

        if ($user->name === 'super_admin' || auth()->id() === $employee->id) {
            return view('frontend.employees.edit', compact('employee'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $user = Auth::user();

        if ($user->name === 'super_admin' || auth()->id() === $employee->id) {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|numeric',
            'profile_image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
            'department' => 'nullable',
        ]);
    
        $employee = Employee::find($employee->id);

        // Update the corresponding user's name and email
        if ($employee->user) {
            $employee->user->update([
                'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
                'email' => $request->input('email'),
            ]);
        }
    
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('profile_images', $fileName, 'public');
            $request->merge(['profile_image' => $fileName]);
        }
    
        $employee->update($request->all());
    
        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Employee $employee)
    {
        $user = Auth::user();
        
        if ($user->name === 'super_admin' || auth()->id() === $employee->id) {
            $employee = Employee::find($employee->id);

            if (!$employee) {
                return redirect()->route('employees.index')
                    ->with('error', 'Employee not found.');
            }

            // Delete the connected user
            if ($employee->user) {
                $employee->user->delete();
            }
        
            $employee->delete();
        
            return redirect()->route('employees.index')
                ->with('success', 'Employee and connected user deleted successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
