<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
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
            'course' => 'required|string|max:255',
            'studentid' => 'required|string|max:255|unique:students,studentid',
            'contact' => 'required|string|max:20',
            'econtact' => 'required|string|max:20',
            'datebirth' => 'required|string|max:20',
            'ename' => 'required|string|max:50',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif,svg|max:2048',
            'proimage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Store files if provided
        $signaturePath = $request->file('signature') ? $request->file('signature')->store('signature', 'public') : null;
        $proImagePath = $request->file('proimage') ? $request->file('proimage')->store('proimage', 'public') : null;

        // Create the student record
        Student::create([
            'firstname' => $validated['firstname'],
            'middlename' => $validated['middlename'],
            'lastname' => $validated['lastname'],
            'address' => $validated['address'],
            'course' => $validated['course'],
            'studentid' => $validated['studentid'],
            'contact' => $validated['contact'],
            'econtact' => $validated['econtact'],
            'datebirth' => $validated['datebirth'],
            'ename' => $validated['ename'],
            'signature' => $signaturePath,
            'proimage' => $proImagePath,
        ]);

        // Redirect with success message
        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    } catch (\Exception $e) {
        // Log the exception for debugging
        \Log::error('Error creating student: ' . $e->getMessage());

        // Redirect back with error message
        return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $student = Student::findOrFail($id);
        return view('student.show', compact('student'));
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
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'course' => 'required|string',
            'studentid' => 'required|string|max:255',
            'contact' => 'required|string|max:15',
            'econtact' => 'required|string|max:15',
            'ename' => 'required|string|max:255',
            'datebirth' => 'required|date',
            'signature' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:1024',
            'qr' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:1024',
            'proimage' => 'nullable|image|max:2048',
          
        ]);

        $student = Student::findOrFail($id);

        $student->firstname = $request->firstname;
        $student->middlename = $request->middlename;
        $student->lastname = $request->lastname;
        $student->address = $request->address;
        $student->course = $request->course;
        $student->studentid = $request->studentid;
        $student->contact = $request->contact;
        $student->econtact = $request->econtact;
        $student->ename = $request->ename;
        $student->datebirth = $request->datebirth;
      

      
        if ($request->hasFile('signature')) {
            if ($student->signature && Storage::exists($student->signature)) {
                Storage::delete($student->signature);
            }
            $student->signature = $request->file('signature')->store('signature');
        }

        if ($request->hasFile('qr')) {
            if ($student->qr && Storage::exists($student->qr)) {
                Storage::delete($student->qr);
            }
            $student->qr = $request->file('qr')->store('qr');
        }

        if ($request->hasFile('proimage')) {
            if ($student->proimage && Storage::exists($student->proimage)) {
                Storage::delete($student->proimage);
            }
            $student->proimage = $request->file('proimage')->store('proimage');
        }

        $student->save();


        return redirect()->route('students.show', $student->id)->with('success', 'Student updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        if (!$student) {
            return redirect()->route('students.index')->with('error', 'Student not found.');
        }    
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }



    // public function saveEdits(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'texts' => 'required|array',
    //         'images' => 'nullable|array',
    //     ]);

    //     $student = Student::find(auth()->user()->id);

    //     // Update text data
    //     foreach ($validatedData['texts'] as $key => $value) {
    //         if (property_exists($student, $key)) {
    //             $student->$key = $value;
    //         }
    //     }

    //     // Update images
    //     if (isset($validatedData['images'])) {
    //         foreach ($validatedData['images'] as $key => $image) {
    //             if ($image instanceof \Illuminate\Http\UploadedFile) {
    //                 // Handle file upload
    //                 $path = $image->store("students/{$student->id}", 'public');
    //                 $student->$key = $path;
    //             }
    //         }
    //     }

    //     $student->save();

    //     return response()->json(['message' => 'Edits saved successfully!'], 200);
    // }
}
