@extends('layouts.header')

@section('content')
<link rel="stylesheet" href="{{ asset('css/id.css') }}">

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

    /* Table Styles */
    table {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        margin-top: 20px;
        border-collapse: collapse;
        padding: 1rem;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #f4f4f4;
    }

    /* Centering Action Buttons */
    .action-btn {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        padding: 5px;
    }

    .action-btn i {
        cursor: pointer;
    }

    .bold-option {
        font-weight: bold;
    }

    .action-btn .edit-btn,
    .action-btn .delete-btn {
        font-size: 14px;
        padding: 2px 8px;
        cursor: pointer;
        background: none;
        border: none;
    }

    .action-btn .edit-btn {
        color: #4d7bfb;
    }

    .action-btn .delete-btn {
        color: #ff6347;
    }

    .action-btn .edit-btn:hover {
        color: #45a049;
    }

    .action-btn .delete-btn:hover {
        color: #ff4500;
    }

    /* Pagination Styles */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        padding: 10px;
    }

    .pagination button {
        padding: 8px 16px;
        margin: 0 4px;
        background-color: #4d7bfb;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .pagination button:hover {
        background-color: #45a049;
    }

    .pagination button.disabled {
        background-color: #ddd;
        cursor: not-allowed;
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
</style>

<div class="container">
    <div>
        <a href="javascript:void(0);" class="create-btn" id="createBtn">
            <span class="btn-text">Create</span>
        </a>
    </div>
    <div>
        <input type="text" class="search-bar" placeholder="Search...">
    </div>
</div>

<!-- Table for displaying students -->
<table id="studentsTable">
    <thead>
        <tr>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Course</th>
            <th>Student ID</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($students as $student)
        <tr>
            <td>{{ $student->lastname }}</td>
            <td>{{ $student->firstname }}</td>
            <td>{{ $student->course }}</td>
            <td>{{ $student->studentid }}</td>
            <td class="action-btn">
                <!-- Edit Button -->
                <form action="{{ route('students.edit', $student->id) }}" method="GET" class="edit-form">
                    <button type="submit" class="edit-btn">✏️</button>
                </form>

                <!-- Delete Button -->
                <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">❌</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="no-records">No data yet</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination Controls (only visible if there is data) -->
@if($students->isNotEmpty())
<div class="pagination" id="paginationControls">
    <button class="disabled">Prev</button>
    <button>1</button>
    <button>2</button>
    <button>3</button>
    <button>4</button>
    <button>5</button>
    <button>Next</button>
</div>
@endif

<!-- Modal Structure -->
<div id="createModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModalBtn">&times;</span>
        <h2>Create Student</h2>
        <form id="createForm" action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}">

            <label for="middlename">Middle Name:</label>
            <input type="text" id="middlename" name="middlename" value="{{ old('middlename') }}">

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}">

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="{{ old('address') }}">

            <label for="course">Course:</label>
            <select id="course" name="course">
                <option value="" disabled selected class="bold-option">Choose a Course</option>
                <option value="BSIT" {{ old('course') == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                <option value="BEED" {{ old('course') == 'BEED' ? 'selected' : '' }}>BEED</option>
                <option value="BSED-SS" {{ old('course') == 'BSED-SS' ? 'selected' : '' }}>BSED-SS</option>
                <option value="BSED-MATH" {{ old('course') == 'BSED-MATH' ? 'selected' : '' }}>BSED-MATH</option>
            </select>

            <div id="courseColor" class="course-color"></div>

            <label for="studentid">Student ID:</label>
            <input type="text" id="studentid" name="studentid" value="{{ old('studentid') }}">

            <label for="contact">Contact number:</label>
            <input type="text" id="contact" name="contact" value="{{ old('contact') }}">

            <label for="econtact">Emergency contact number:</label>
            <input type="text" id="econtact" name="econtact" value="{{ old('econtact') }}">

            <label for="ename">Emergency contact person:</label>
            <input type="text" id="ename" name="ename" value="{{ old('ename') }}">

            <label for="signature">Signature:</label>
            <input type="file" id="signature" name="signature">

            <label for="qr">QR Code:</label>
            <input type="file" id="qr" name="qr">

            <label for="proimage">Profile Image:</label>
            <input type="file" id="proimage" name="proimage">

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

    courseSelect.addEventListener('change', (e) => {
        const course = e.target.value;

        // Hide the placeholder option once a course is selected
        if (course) {
            const firstOption = courseSelect.querySelector('option[value=""]');
            if (firstOption) {
                firstOption.style.display = 'none';
            }
        }

        // Update the color display based on selected course
        if (course === 'BSIT') {
            courseColorDiv.style.backgroundColor = 'orange';
            courseColorDiv.textContent = 'BSIT';
        } else if (course === 'BEED') {
            courseColorDiv.style.backgroundColor = '#5ec5fc';
            courseColorDiv.textContent = 'BEED';
        } else if (course === 'BSED-MATH') {
            courseColorDiv.style.backgroundColor = 'green';
            courseColorDiv.textContent = 'BSED-MATH';
        } else if (course === 'BSED-SS') {
            courseColorDiv.style.backgroundColor = 'purple';
            courseColorDiv.textContent = 'BSED-SS';
        }
    });
</script>

@endsection
