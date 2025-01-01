@extends('layouts.header')

@section('content')
<link rel="stylesheet" href="{{ asset('css/id.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        color:white;
        font-size: 20px;
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
    <script>

        Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ $message }}",
        showConfirmButton: false,
        timer: 1500
        });
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            position: "top-end",
            icon: 'error',
            title: '{{ $message }}',
            html: `
                <style="text-align: left;">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach

            `,
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif




<div class="cards-container">
    @forelse($students as $student)
        <div class="student-card" onclick="window.location='{{ route('students.show', $student->id) }}'">
            <img src="{{ $student->proimage ? asset('storage/'.$student->proimage) : asset('images/default-avatar.png') }}" alt="Student Image">
            <div class="name">{{ $student->firstname }} {{ $student->lastname }}</div>
            <div class="course">{{ $student->course }}</div>
        </div>
    @empty
        <div class="no-records">No data yet</div>
    @endforelse
</div>

<div id="createModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModalBtn">&times;</span>
        <div style="text-align: center;">
          <img src="{{ asset('img/student.png') }}" alt="" style="width: 50px; height: auto;">
        </div>

        <h2 style="text-align: center;">Enter Student ID</h2>

        <!-- Search Bar for Student ID -->

        <div class="search-con">
            <input type="text" id="searchStudentId" placeholder="Enter Student ID">

            <button id="searchBtn">Submit</i></button>
        </div>

        <p id="searchError" style="color: red; display: none;">Wa nakit an ang imong gipangita balik lang ugma</p>

        <form id="createForm" action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" style="display: none;">
            @csrf

            <input type="text" hidden id="firstname" name="firstname" value="{{ old('firstname') }}">
            <input type="text" hidden id="middlename" name="middlename" value="{{ old('middlename') }}">
            <input type="text" hidden id="lastname" name="lastname" value="{{ old('lastname') }}">
            <input type="text" hidden id="address" name="address" value="{{ old('address') }}">
            <select id="course" hidden name="course">
                <option value="" disabled selected class="bold-option">Choose a Course</option>
                <option value="BSIT" {{ old('course') == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                <option value="BEED" {{ old('course') == 'BEED' ? 'selected' : '' }}>BEED</option>
                <option value="BSED-SS" {{ old('course') == 'BSED-SS' ? 'selected' : '' }}>BSED-SS</option>
                <option value="BSED-Math" {{ old('course') == 'BSED-Math' ? 'selected' : '' }}>BSED-MATH</option>
            </select>

            <div id="courseColor" class="course-color"></div>
            <input type="text" hidden id="studentid" name="studentid" value="{{ old('studentid') }}">
            <input type="text" hidden id="contact" name="contact" value="{{ old('contact') }}">
            <input type="text" hidden id="econtact" name="econtact" value="{{ old('econtact') }}">
            <input type="text" hidden id="birthdate" name="datebirth" value="{{ old('datebirth') }}">
            <input type="text" hidden id="ename" name="ename" value="{{ old('ename') }}">

            <label for="signature">Signature:</label>
            <input type="file" id="signature" name="signature">
            @if ($errors->has('signature'))
                <span class="text-danger">{{ $errors->first('signature') }}</span>
            @endif

            <!-- <label for="qr-code">Qr Code:</label>
            <img id="qr-code" alt="QR Code" name="qr">
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
    const courseSelect = document.getElementById('course');
    const courseColorDiv = document.getElementById('courseColor');
    const createForm = document.getElementById('createForm');
    const searchStudentId = document.getElementById('searchStudentId');
    const searchError = document.getElementById('searchError');
    const firstnameInput = document.getElementById('firstname');
    const middlenameInput = document.getElementById('middlename');
    const lastnameInput = document.getElementById('lastname');
    const addressInput = document.getElementById('address');
    const studentidInput = document.getElementById('studentid');
    const contactInput = document.getElementById('contact');
    const econtactInput = document.getElementById('econtact');
    const birthdateInput = document.getElementById('birthdate');
    const enameInput = document.getElementById('ename');
    // const qrcode = document.getElementById('qr-code');

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
        const studentId = searchStudentId.value.trim();
        if (!studentId) {
            alert('Please enter a Student ID.');
            return;
        }

        const apiKey = '{{ (config('system.api_key')) }}';

        fetch(`https://api-portal.mlgcl.edu.ph/api/external/student-list?student_id=${studentId}`, {
            method: 'GET',
            headers: {
                'Origin': 'http://idmaker.test',
                'x-api-key': apiKey,
                'Content-Type': 'application/json'
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Student not found.');
            }
            return response.json();
        })
        .then(data => {

            const student = data.data.find(s => s.student_identification_number[0]?.student_id === studentId);

            if (student) {

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
                // qrcode. = student.qr_code || '';
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
