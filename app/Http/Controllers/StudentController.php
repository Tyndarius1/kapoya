<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('student', compact('students'));
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
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'studentid' => 'required|string|max:255|unique:students,studentid',
            'contact' => 'required|string|max:20',
            'econtact' => 'required|string|max:20',
            'ename' => 'required|string|max:20',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'qr' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'proimage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $signaturePath = $request->file('signature') ? $request->file('signature')->store('signatures') : null;
        $qrPath = $request->file('qr') ? $request->file('qr')->store('qr_codes') : null;
        $proImagePath = $request->file('proimage') ? $request->file('proimage')->store('profile_images') : null;


        $student = Student::create([
            'firstname' => $validated['firstname'],
            'middlename' => $validated['middlename'],
            'lastname' => $validated['lastname'],
            'address' => $validated['address'],
            'course' => $validated['course'],
            'studentid' => $validated['studentid'],
            'contact' => $validated['contact'],
            'econtact' => $validated['econtact'],
            'ename' => $validated['ename'],
            'signature' => $signaturePath,
            'qr' => $qrPath,
            'proimage' => $proImagePath,
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully!');

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
        $student = Student::find($id);

        // Check if the student exists
        if (!$student) {
            return redirect()->route('students.index')->with('error', 'Student not found.');
        }

        // Delete the student
        $student->delete();

        // Redirect back to the student list with a success message
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
