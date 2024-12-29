@extends('layouts.header')

@section('content')

<!--  -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- id functionality -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/functionality.css') }}">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<style>
    body {
        background: #F0F1F5;
    }
    .card-body {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #F0F1F5;
        margin-top:70px;
    }
    .card {
        border: ;
        background: #F0F1F5;
    }
    .id-card-canvas {
        border-radius: 10px;
    }

    /* Sidebar styles */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 60px;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 20px;
      
    }
    .sidebar a {
        color: #6A6E71;
        text-align: center;
        padding: 15px;
        font-size: 25px;
        text-decoration: none;
        margin: 10px 0;
    }
 

    /* Content container */
    .content {
        margin-left: 70px;
        width: calc(100% - 70px);
    }

    /* Modal Styles */
    .modal-content {
        border-radius: 10px;
        background-color: #fff;
    }
    .modal-header {

        color: black;
        border-bottom: 1px solid #ddd;
        padding: 15px;
    }
    .modal-header .close {
        color: white;
    }
    .modal-body {
        padding: 30px;

    }
    .modal-body input,
    .modal-body select,
    .modal-body button {
        width: 100%;
        padding: 12px 15px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    .modal-body button {
        background-color: #28a745;
        color: white;
        cursor: pointer;
    }
    .modal-body button:hover {
        background-color: #218838;
    }

    .modal-body label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    /* Input field focus */
    .modal-body input:focus,
    .modal-body select:focus {
        border-color: #007bff;
        outline: none;
    }

    .bold-option {
        font-weight: bold;
    }

    /* Footer styles */
    .modal-footer {
        border-top: 1px solid #ddd;
        padding: 15px;
        background-color: #f8f9fa;
    }

    .modal-footer button {
        width: 48%;
        border-radius: 5px;
        padding: 10px;
    }

    .modal-footer .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    .modal-footer .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

</style>


<div class="sidebar">

    <a href=""><i class="fas fa-arrow-left"></i></a>
    <a href="/student"> <i class="fas fa-arrow-left" style="color: blue; font-size: 35px;"></i></a>
    <a href="#" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></a> <!-- Edit button -->
    <a href="#"> <i class="fa fa-print"></i></a>
    <a href="#"><i class="fa fa-save"></i></a>
</div>


<div class="content">
    <div class="card mt-2">
        <div class="card-body" id="canvas-container">
        <div class="toolbar" id="toolbar">
    <!-- Image-related actions -->
    <button id="bgRemoveBtn">
        <i class="fas fa-eraser"></i>
        <span class="tooltip">Remove Background</span>
    </button>
    <button id="resizeBtn">
        <i class="fas fa-expand"></i> 
        <span class="tooltip">Resize</span> 
    </button>
    <button id="resetBtn">
        <i class="fas fa-compress"></i> 
        <span class="tooltip">Reset Size</span> 
    </button>
    <button id="flipBtn">
        <i class="fas fa-arrows-alt-v"></i> 
        <span class="tooltip">Flip</span>
    </button>
</div>

<!-- Text Toolbar -->
<div class="text-toolbar" id="text-toolbar" >
    <!-- Text-related actions -->
    <select id="font-selector" style="font-size: 16px;">
        <!-- Options dynamically populated -->
    </select>

    <button id="decrease-font" title="Decrease Font Size"><i class="fas fa-minus"></i></button>
    <input type="text" value="16" id="font-size" style="width: 50px; text-align: center; font-size: 16px; border: 1px solid #ddd; border-radius: 4px;">
    <button id="increase-font" title="Increase Font Size"><i class="fas fa-plus"></i></button>

    <button id="bold-button" title="Bold"><i class="fas fa-bold"></i></button>
    <button id="italic-button" title="Italic"><i class="fas fa-italic"></i></button>
    <button id="underline-button" title="Underline"><i class="fas fa-underline"></i></button>

    <button id="align-left" title="Align Left"><i class="fas fa-align-left"></i></button>
    <button id="align-center" title="Align Center"><i class="fas fa-align-center"></i></button>
    <button id="align-right" title="Align Right"><i class="fas fa-align-right"></i></button>

    <button class="text-color-picker" title="Change Text Color">
        <span class="icon" id="text-icon">A</span>
        <input type="color" id="text-color-picker" value="#000000">
    </button>
</div>


<!-- Student ID -->
    <div class="pinakamain">
        <div class="main-container">
            <div class="main-one">
                <div class="one">
                    <div class="logo">
                        <img src="mlg_logo_frm_ppt.png" alt="MLG Logo">
                        <p style="font-family: 'Poppins', sans-serif; font-weight: bold;letter-spacing: 1.1px;">MLG COLLEGE <br> OF LEARNING, INC<br></p>
                        <p style="font-family: Arial; font-size: 6px;letter-spacing: 1.2px;">Brgy. Atabay, Hilongos, Leyte</p>
                    </div>
                    <div class="qr-code">
                        <img src="qr.png" alt="Student QR Code">
                    </div>
                    <div class="signature" >
                        <img src="sig.png" alt="Signature" id="draggableImageSignature">
                    </div>
                    <div class="main-image">
                        <div class="image">
                            <img src="sheesh.jpg" alt="Student Image" id="draggableImage">
                        </div>
                    </div> 
                </div>  
            </div>
            <div class="mainconsaubos">
                <div class="main-two">
                    <div class="date editable" contenteditable="true" id="editable-text-date">
                        <p>Date of birth:<br>12/08/2003</p>
                    </div>
                    <div class="main-name">
                        <div class="name editable" contenteditable="true" id="editable-text-name">
                            <h3>DEDAL<br>BOYET A.</h3>
                        </div>
                        <div class="brgy editable" contenteditable="true" id="editable-text-brgy">
                            <p>Brgy. Manaul, Hilongos</p>
                        </div>
                    </div>
                </div>
                <div class="numcourse">
                    <div class="number">
                        <h4>22-003356</h4>
                    </div>
                    <div class="course">
                        <h4>BSIT</h4>
                    </div>
                </div>
                <div class="last">
                    <div class="num1">
                        <p>⁦https://mlgcl.edu.ph⁩</p>
                    </div>
                    <div class="num2">
                        <p>mlg@mlgcl.edu.ph</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Back of the ID -->
        <div class="likod">
            <div class="likod-one">
                <div class="one-table">
                    <table class="table-container">
                        <tr>
                            <th class="semester-title">Semester</th>
                            <th>2022-2023</th>
                            <th><span>School Year</span><br>2023-2024</th>
                            <th>2024-2025</th>
                            <th>2025-2026</th>
                        </tr>
                        <tr>
                            <td>First</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Second</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div class="one-right">
                    <div class="parag">
                        <p>This is to certify that the person <br> whose picture and signature appear herein is a bonafide student of <br> <span class="parag1span">MLG College of Learning, Inc.</span> </p>
                    </div>
                    <div class="parag-name">
                        <p>MARY LILIBETH O. YAN, DEV.ED.D <span> <br> School Director </span></p>
                    </div>
                    <div class="parag2">
                        <p><span class="span">IMPORTANT REMINDERS</span> Always wear this ID while inside the school campus. <span class="span1">Do not forget your STUDENT ID NUMBER.</span>
                        </p>
                    </div>
                    <div class="parag3">    
                        <p>If lost and found, please surrender this ID to the STUDENT AFFAIRS OFFICE. MLG College of Learning, Inc. Brgy. Atabay, Hilongos, Leyte</p>
                    </div>
                    <div class="parag4" id="editable-text-parag4">
                        <p>
                            In case of emergency,<br>please contact <br>
                            <span class="editable" id="editable-contact">
                                <span id="editable-name" contenteditable="true">MARIA LORNA DEDAL</span> <br />
                                <span id="editable-number" contenteditable="true">0920-8876-778</span>
                            </span>
                        </p>
                    </div>
                    <div class="parag5">
                        <p>PLEASE SCAN THE QR <br>CODE AT THE FRONT FOR <br>MORE VALIDATION & <br>CONTACT INFORMATION.</p>
                    </div>
                </div>
            </div>
            <div class="likod-two">
                <div class="likod-two-last">
                    <p>⁦https://www.facebook.com/mlgcl/⁩</p>
                </div>
            </div>
        </div>

    </div>
        </div>
    </div>
</div>



<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Student Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createForm" action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" value="{{ old('firstname', $student->firstname) }}">

                    <label for="middlename">Middle Name:</label>
                    <input type="text" id="middlename" name="middlename" value="{{ old('middlename', $student->middlename) }}">

                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname" value="{{ old('lastname', $student->lastname) }}">

                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $student->address) }}">

                    <label for="course">Course:</label>
                    <select id="course" name="course">
                        <option value="" disabled class="bold-option">Choose a Course</option>
                        <option value="BSIT" {{ old('course', $student->course) == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                        <option value="BEED" {{ old('course', $student->course) == 'BEED' ? 'selected' : '' }}>BEED</option>
                        <option value="BSED-SS" {{ old('course', $student->course) == 'BSED-SS' ? 'selected' : '' }}>BSED-SS</option>
                        <option value="BSED-Math" {{ old('course', $student->course) == 'BSED-Math' ? 'selected' : '' }}>BSED-MATH</option>
                    </select>

                    <div id="courseColor" class="course-color"></div>

                    <label for="studentid">Student ID:</label>
                    <input type="text" id="studentid" name="studentid" value="{{ old('studentid', $student->studentid) }}">

                    <label for="contact">Contact number:</label>
                    <input type="text" id="contact" name="contact" value="{{ old('contact', $student->contact) }}">

                    <label for="econtact">Emergency contact number:</label>
                    <input type="text" id="econtact" name="econtact" value="{{ old('econtact', $student->econtact) }}">

                    <label for="ename">Emergency contact person:</label>
                    <input type="text" id="ename" name="ename" value="{{ old('ename', $student->ename) }}">

                    <label for="datebirth">Date of Birth:</label>
                    <input type="date" id="datebirth" name="datebirth" value="{{ old('datebirth', $student->datebirth) }}">

                    <label for="signature">Signature:</label>
                    <input type="file" id="signature" name="signature">
                    @if ($student->signature)
                        <img src="{{ asset('storage/' . $student->signature) }}" alt="QR Code" width="30%">
                        @else
                        <p>No signature code available.</p>
                    @endif

                                    <label for="qr">QR Code:</label>
                                    <input type="file" id="qr" name="qr">
                                    @if ($student->qr)
                        <img src="{{ asset('storage/' . $student->qr) }}" alt="QR Code" width="30%">
                    @else
                        <p>No QR code available.</p>
                    @endif

                                    <label for="proimage">Profile Image:</label>
                                    <input type="file" id="proimage" name="proimage">
                                    @if ($student->proimage)
                        <img src="{{ asset('storage/' . $student->proimage) }}" alt="QR Code" width="30%">
                    @else
                        <p>No profile image available.</p>
                    @endif

                    <button type="submit">Update</button>
                </form>
             
            </div>
        </div>
    </div>
</div>

<!-- modal script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- id script -->

  <!-- Image Toolbar JS FUNCTIONALITY -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
     <script src="{{ asset('js/tina.js') }}"></script>

@endsection
