@extends('layouts.header')

@section('content')
<link rel="stylesheet" href="{{ asset('css/id.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .container {
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .create-btn {
        display: inline-flex;
        align-items: center;
        background-color: #4d7bfb;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .create-btn:hover {
        background-color: #45a049;
        transform: scale(1.05);
    }

    .create-btn .btn-text {
        font-size: 16px;
    }

    .no-records {
        color: #888;
        font-size: 14px;
        text-align: center;
        margin-top: 20px;
    }

    /* Search Bar Styles */
    .search-bar {
        width: 300px;
        padding: 10px 15px;
        border-radius: 25px;
        border: 1px solid #d1d5db;
        background-color: #ffffff;
        font-size: 16px;
        color: #333;
        transition: all 0.3s ease;
        outline: none;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .search-bar:focus {
        border-color: #4d7bfb;
        box-shadow: 0 0 8px rgba(77, 123, 251, 0.3);
        background-color: #f9f9f9;
    }

    .search-bar::placeholder {
        color: #aaa;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        padding-top: 60px;
    }

    .modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
    }

    .close-btn {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        float: right;
        cursor: pointer;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }

    input[type="text"], select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    button[type="submit"] {
        background-color: #4d7bfb;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 20px;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }

    .course-color {
        margin-top: 10px;
        font-weight: bold;
        padding: 5px;
        color: white;
        border-radius: 4px;
        width: 100px;
        text-align: center;
    }

    .cards-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        margin-top: 1px;
    }

    .student-card {
        width: 200px;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
        padding: 10px;
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .student-card:hover {
        transform: scale(1.05);
    }

    .student-card img {
        width: 90%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        margin-top:10px;
    }

    .student-card .name {
        font-weight: bold;
        font-size: 18px;
        margin: 8px 0;
    }

    .search-con {
       display:flex;
       flex-direction:column;
       gap:10px;
    }

    .search-con button {
     
        border: none;
        background: none;
        cursor: pointer;
        background-color: #4d7bfb;
        padding: 10px 20px; 
        border-radius: 5px;
    }

    .search-con button i {

    }

</style>

<div class="container">
    <div>
        <a href="javascript:void(0);" class="create-btn" id="createBtn">
            <span class="btn-text">Create ID</span>
        </a>
    </div>
    <div>
        <input type="text" class="search-bar" placeholder="Search...">
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="cards-container">
    @forelse($employees as $employee)
        <div class="student-card" onclick="window.location='{{ route('employee.show', $employee->id) }}'">
            <img src="{{ $employee->proimage ? asset('storage/'.$employee->proimage) : asset('images/default-avatar.png') }}" alt="Employee Image">
            <div class="name">{{ $employee->firstname }} {{ $employee->lastname }}</div>
            <div class="course">{{ $employee->course }}</div>
        </div>
    @empty
        <div class="no-records">No data yet</div>
    @endforelse
</div>

<div id="createModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModalBtn">&times;</span>
        <h2>Enter Employee ID</h2>

        <!-- Search Bar for Student ID -->
       
        <div class="search-con">
            <input type="text" id="searchStudentId" placeholder="Enter Employee ID">
            <button id="searchBtn">Submit</i></button>
        </div>
      
        <p id="searchError" style="color: red; display: none;">Employee not found. Please check the ID.</p>

        <form id="createForm" action="{{ route('emloyees.store') }}" method="POST" enctype="multipart/form-data" style="display: none;">
            @csrf

            <input type="text" hidden id="firstname" name="firstname" value="{{ old('firstname') }}">
            <input type="text" hidden id="middlename" name="middlename" value="{{ old('middlename') }}">
            <input type="text" hidden id="lastname" name="lastname" value="{{ old('lastname') }}">
            <input type="text" hidden id="address" name="address" value="{{ old('address') }}">
            <!-- <select id="course" hidden name="course">
                <option value="" disabled selected class="bold-option">Choose a Course</option>
                <option value="BSIT" {{ old('course') == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                <option value="BEED" {{ old('course') == 'BEED' ? 'selected' : '' }}>BEED</option>
                <option value="BSED-SS" {{ old('course') == 'BSED-SS' ? 'selected' : '' }}>BSED-SS</option>
                <option value="BSED-Math" {{ old('course') == 'BSED-Math' ? 'selected' : '' }}>BSED-MATH</option>
            </select> -->

            <!-- <div id="courseColor" class="course-color"></div> -->
            <input type="text" hidden id="employeeid" name="employeeid" value="{{ old('employeeid') }}">
            <input type="text" hidden id="birthdate" name="datebirth" value="{{ old('datebirth') }}">
            <label for="signature">Signature:</label>
            <input type="file" id="signature" name="signature">
            @if ($errors->has('signature'))
                <span class="text-danger">{{ $errors->first('signature') }}</span>
            @endif

            <!-- <label for="qr">Qr Code:</label>
            <input type="file" id="qr" name="qr">
            @if ($errors->has('qr'))
                <span class="text-danger">{{ $errors->first('qr') }}</span>
            @endif -->

            <label for="proimage">Profile Image:</label>
            <input type="file" id="proimage" name="proimage">
            @if ($errors->has('proimage'))
                <span class="text-danger">{{ $errors->first('proimage') }}</span>
            @endif

            <button type="submit">Submit</button>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('createModal');
    const createBtn = document.getElementById('createBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
   //  const courseSelect = document.getElementById('course');
   //  const courseColorDiv = document.getElementById('courseColor');
    const createForm = document.getElementById('createForm');
    const searchEmployeeId = document.getElementById('searchEmployeeId');
    const searchError = document.getElementById('searchError');
    const firstnameInput = document.getElementById('firstname');
    const middlenameInput = document.getElementById('middlename');
    const lastnameInput = document.getElementById('lastname');
    const addressInput = document.getElementById('address');
    const employeeidInput = document.getElementById('employeeid');
    const birthdateInput = document.getElementById('birthdate');

    createBtn.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    closeModalBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    const searchBtn = document.getElementById('searchBtn');
    searchBtn.addEventListener('click', () => {
        const employeeId = searchEmployeeId.value.trim();
        if (!employeeId) {
            alert('Please enter a Employee ID.');
            return;
        }

        const apiKey = '{{ (config('system.api_key')) }}';

        fetch(`https://api-portal.mlgcl.edu.ph/api/external/employee-list?employee_id=${employeeId}`, {
            method: 'GET',
            headers: {
                'Origin': 'http://idmaker.test',
                'x-api-key': apiKey,
                'Content-Type': 'application/json'
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Employee not found.');
            }
            return response.json();
        })
        .then(data => {
            const employee = data.data.find(s => s.student_identification_number[0]?.student_id === studentId);
            if (student) {
                // Populate form fields with student data
                firstnameInput.value = student.first_name || '';
                middlenameInput.value = student.middle_name || '';
                lastnameInput.value = student.last_name || '';
                addressInput.value = student.address?.barangay ? `${student.address.barangay}, ${student.address.municipality}, ${student.address.province}` : '';
                courseSelect.value = student.course?.code || '';
                studentidInput.value = student.student_identification_number[0]?.student_id || '';
                contactInput.value = student.contact_number || '';
                econtactInput.value = student.emergency_contact?.number || '';
                birthdateInput.value = student.birthdate || '';
                enameInput.value = student.emergency_contact?.name || '';
                searchError.style.display = 'none';


                createForm.style.display = 'block';
            } else {
                throw new Error('Student not found.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            searchError.style.display = 'block';
            createForm.style.display = 'none'; 
        });
    });
</script>

@endsection
<!-- for color position -->


     <!-- <label for="course">Course:</label>
                    <select id="course" name="course">
                        <option value="" disabled class="bold-option">Choose a Course</option>
                        <option value="BSIT" {{ old('course', $student->course) == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                        <option value="BEED" {{ old('course', $student->course) == 'BEED' ? 'selected' : '' }}>BEED</option>
                        <option value="BSED-SS" {{ old('course', $student->course) == 'BSED-SS' ? 'selected' : '' }}>BSED-SS</option>
                        <option value="BSED-Math" {{ old('course', $student->course) == 'BSED-Math' ? 'selected' : '' }}>BSED-MATH</option>
                    </select>

                    <div id="courseColor" class="course-color"></div> -->