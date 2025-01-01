<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
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
            'contact' => 'required|string|max:20',   
            'econtact' => 'required|string|max:20',
            'position' => 'required|string|max:255',
            'employeeid' => 'required|string|max:255|unique:employees,employeeid',
            'datebirth' => 'required|string|max:20', 
            'ename' => 'required|string|max:50',
            'qr' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif,svg|max:2048',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif,svg|max:2048',
            'proimage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);
      

        $signaturePath = $request->file('signature') ? $request->file('signature')->store('signature', 'public') : null;
        $proImagePath = $request->file('proimage') ? $request->file('proimage')->store('proimage', 'public') : null;
        $qrPath = $request->file('qr') ? $request->file('qr')->store('qr', 'public') : null;

        // Create the student record
        Employee::create([
            'firstname' => $validated['firstname'],
            'middlename' => $validated['middlename'],
            'lastname' => $validated['lastname'],
            'address' => $validated['address'],
            'contact' => $validated['contact'],
            'econtact' => $validated['econtact'],
            'position' => $validated['position'],
            'employeeid' => $validated['employeeid'],
            'datebirth' => $validated['datebirth'],
            'ename' => $validated['ename'],
            'qr' => $qrPath,
            'signature' => $signaturePath,
            'proimage' => $proImagePath,
            'color' => $validated['color'],
        ]);
        return redirect()->route('employee.index')->with('success', 'Employee created successfully!');
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
        $employee = Employee::findOrFail($id);
        return view('employee.show', compact('employee'));
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
        $validated = $request->validate([
            'firstname' => 'nullable|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:15',
            'econtact' => 'nullable|string|max:15',
            'position' => 'nullable|string|max:255',
            'employeeid' => 'nullable|string|max:255',
            'datebirth' => 'nullable|date',
            'ename' => 'nullable|string|max:255',
            'qr' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:1024',
            'signature' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:1024',
            'proimage' => 'nullable|image|max:2048',
          
        ]);

        $employee = Employee::findOrFail($id);

        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->lastname = $request->lastname;
        $employee->address = $request->address;
        $employee->contact = $request->contact;
        $employee->econtact = $request->econtact;
        $employee->position = $request->position;
        $employee->employeeid = $request->employeeid;
        $employee->datebirth = $request->datebirth;
        $employee->ename = $request->ename;
     

       

      
        if ($request->hasFile('signature')) {
            if ($employee->signature && Storage::exists($employee->signature)) {
                Storage::delete($employee->signature);
            }
            $employee->signature = $request->file('signature')->store('signature');
        }

        if ($request->hasFile('qr')) {
            if ($employee->qr && Storage::exists($employee->qr)) {
                Storage::delete($employee->qr);
            }
            $employee->qr = $request->file('qr')->store('qr');
        }

        if ($request->hasFile('proimage')) {
            if ($employee->proimage && Storage::exists($employee->proimage)) {
                Storage::delete($employee->proimage);
            }
            $employee->proimage = $request->file('proimage')->store('proimage');
        }

        $employee->save();


        return redirect()->route('employees.show', $employee->id)->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
