<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $employees = Employee::all();
        return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    try {
        // Validate the request
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'employeeid' => 'required|string|max:255|unique:students,studentid',
            'datebirth' => 'required|string|max:20',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif,svg|max:2048',
            'proimage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $signaturePath = $request->file('signature') ? $request->file('signature')->store('signature', 'public') : null;
        $proImagePath = $request->file('proimage') ? $request->file('proimage')->store('proimage', 'public') : null;

        // Create the student record
        Employee::create([
            'firstname' => $validated['firstname'],
            'middlename' => $validated['middlename'],
            'lastname' => $validated['lastname'],
            'address' => $validated['address'],
            'employeeid' => $validated['employeeid'],
            'datebirth' => $validated['datebirth'],
            'signature' => $signaturePath,
            'proimage' => $proImagePath,
        ]);
        return redirect()->route('employee.index')->with('success', 'Student created successfully!');
    } catch (\Exception $e) {
        \Log::error('Error creating student: ' . $e->getMessage());
        return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
