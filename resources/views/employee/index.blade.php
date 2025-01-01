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

    .color{
         display: flex;
         gap:10px;
        flex-direction: row;
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
            timer: 2000
        });
    </script>
@endif
<div class="cards-container">
    @forelse($employees as $employee)
        <div class="student-card" onclick="window.location='{{ route('employees.show', $employee->id) }}'">
            <img src="{{ $employee->proimage ? asset('storage/'.$employee->proimage) : asset('images/default-avatar.png') }}" alt="Student Image">
            <div class="name">{{ $employee->firstname }} {{ $employee->lastname }}</div>
        </div>
    @empty
        <div class="no-records">No data yet</div>
    @endforelse
</div>

<div id="createModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModalBtn">&times;</span>
        <div style="text-align: center;">
            <i class="fas fa-users" style="font-size: 50px;"></i>
        </div>

        <h2 style="text-align: center;">Enter Employee Name</h2>

      
       
        <div class="search-con">
            <input type="text" id="searchEmployeeName" placeholder="Enter Name">
            <ul id="suggestionsList" style="list-style-type: none; padding: 0; margin-top: 5px; background: white; border: 1px solid #ccc; max-height: 150px; overflow-y: auto;"></ul>
        </div>
        <p id="searchError" style="color: red; display: none;">Employee not found. Please try again.</p>

      
        <p id="searchError" style="color: red; display: none;">Employee not found. balik ugma.</p>

        <form id="createForm" action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" style="display: none;">
            @csrf

            <input type="text" hidden id="firstname" name="firstname" value="{{ old('firstname') }}">
            <input type="text" hidden id="middlename" name="middlename" value="{{ old('middlename') }}">
            <input type="text" hidden id="lastname" name="lastname" value="{{ old('lastname') }}">
            <input type="text" hidden id="address" name="address" value="{{ old('address') }}">
            <input type="text" hidden id="contact" name="contact" value="{{ old('contact') }}">
            <input type="text" hidden id="econtact" name="econtact" value="{{ old('econtact') }}">
            <input type="text" hidden id="ename" name="ename" value="{{ old('ename') }}">
           
            <input type="text" hidden id="birthdate" name="datebirth" value="{{ old('datebirth') }}">
           
            <h2 id="display"></h2>
            <input  hidden type="file" id="qr" name="qr">
                @if (isset($employee->qr_code))         
                    <img src="{{ asset('storage/'.$employee->qr_code) }}" alt="QR Code" style="max-width: 200px; margin-top: 10px;">
                @endif

            <label for="position">Position</label>
            <input type="text"id="position" name="position" value="{{ old('position') }}">
            <style>
               
            </style>
            <div class="color">             
            <button class="text-color-picker" title="Change Text Color">
                <input 
                    type="color" 
                    name="color" 
                    id="text-color-picker" 
                    value="{{ $employee->color ?? '#000000' }}" 
                >
            </button> 
            </div>

            <label for="employeeid">Employee ID</label>
            <input type="text"id="employeeid" name="employeeid" value="{{ old('employeeid') }}">
            <label for="signature">Signature:</label>
            <input type="file" id="signature" name="signature">
            @if ($errors->has('signature'))
                <span class="text-danger">{{ $errors->first('signature') }}</span>
            @endif

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
    const searchInput = document.getElementById('searchEmployeeName');
    const suggestionsList = document.getElementById('suggestionsList');
    const createForm = document.getElementById('createForm');
    const searchError = document.getElementById('searchError');
    const firstnameInput = document.getElementById('firstname');
    const middlenameInput = document.getElementById('middlename');
    const lastnameInput = document.getElementById('lastname');
    const addressInput = document.getElementById('address');
    const contactInput = document.getElementById('contact');
    const econtactInput = document.getElementById('econtact');
    const birthdateInput = document.getElementById('birthdate');
    const display = document.getElementById('display');
   
  
    const qrPreview = document.querySelector('img[alt="QR Code"]');
    if (qrPreview) {
 
        qrPreview.src = employee.qr_code ? asset('storage/' + employee.qr_code) : '';
    }
        const enameInput = document.getElementById('ename');

    let studentData = [];

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

    const apiKey = '{{ (config('system.api_key')) }}';


    createBtn.addEventListener('click', () => {
        fetch('https://api-portal.mlgcl.edu.ph/api/external/employee-list', {
            method: 'GET',
            headers: {
                'Origin': 'http://idmaker.test',
                'x-api-key': apiKey,
                'Content-Type': 'application/json'
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch employee data.');
                }
                return response.json();
            })
            .then(data => {
                employeeData = data.data || [];
            })
            .catch(error => {
                console.error('Error fetching employee data:', error);
            });
    });

    // Handle search input
    searchInput.addEventListener('keyup', () => {
        const query = searchInput.value.trim().toLowerCase();
        suggestionsList.innerHTML = '';

        if (query) {
            const filteredEmployees = employeeData.filter(employee =>
            employee.first_name.toLowerCase().includes(query) ||
            employee.last_name.toLowerCase().includes(query)
            );

            filteredEmployees.forEach(employee => {
                const listItem = document.createElement('li');
                listItem.textContent = `${employee.first_name} ${employee.last_name}`;
                listItem.addEventListener('click', () => selectEmployee(employee));
                suggestionsList.appendChild(listItem);
            });
        }
    });

   
    function selectEmployee(employee) {
        firstnameInput.value = employee.first_name || '';
        middlenameInput.value = employee.middle_name || '';
        lastnameInput.value = employee.last_name || '';
        addressInput.value = employee.address?.barangay ? `${employee.address.barangay}, ${employee.address.municipality}, ${employee.address.province}` : '';
        contactInput.value = employee.contact_number || '';
        econtactInput.value = employee.emergency_contact?.number || '';
        birthdateInput.value = employee.birthdate || '';
        enameInput.value = employee.emergency_contact?.name || '';
        display.textContent = (employee.first_name || '') + ' ' + (employee.last_name || '');

      
        createForm.style.display = 'block';
        suggestionsList.innerHTML = ''; 
    }
</script>

@endsection
