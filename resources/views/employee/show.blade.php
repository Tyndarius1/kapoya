@extends('layouts.header')

@section('content')

<!--  -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- id functionality -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/employee.css') }}">
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

    .barag{
    margin-top:-20px;
  }
  .logo img{
    margin-top:-2px;
  }
  .mlg{
    margin-top:-8px;
  }
  .qr-code img{
    margin-top:-10px;
  }

</style>


<div class="sidebar">

    <a href=""><i class="fas fa-arrow-left"></i></a>
    <a href="/employee"> <i class="fas fa-arrow-left" style="color: blue; font-size: 35px;"></i></a>
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
        <input type="color" id="text-color-picker" value="#000000">
    </button>
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

<style>
    .qr-code img{
        width: 85px;
        height: 85px;

    }
     .logo img{
        margin-right:10px;
     }
    .logo p{
        margin-top:-10px;
        margin-right:8px;
    }

</style>
<!-- Student ID -->
<div class="pinakamain">
			<div class="main-container">
				<div class="main-one">
					<div class="one">
						<div class="logo">
							<img src="{{asset('img/mlg.png')}}" alt="MLG Logo" />
							<p >
								MLG COLLEGE <br>
								OF LEARNING, INC<br>
                                Brgy. Atabay, Hilongos, Leyte
							</p>

						</div>
						<div class="qr-code">
                        <img id="qr-code" src="{{ asset('img/qr.png')}}" alt="Student QR Code">
						</div>
						<div class="signature">
							<img src="{{ asset('storage/' . $employee->signature) }}" alt="Signature" id="draggableImageSignature" />
						</div>
						<div class="main-image">
							<div class="image">
								<img src="{{ asset('storage/' . $employee->proimage) }}" alt="Student Image" id="draggableImage" />
							</div>
						</div>
					</div>
				</div>

                <style>
                    .circle{
                       margin-top: 100px;
                    }
                    .name h5{
                        margin-top:-20px;
                    }
                    .numcourse{
                        margin-top:-10px;
                    }
                    .number h4{
                        font-size:16px;
                    }
                    .course h4{
                        font-size:15px;
                    }
                    .last{
                        margin-bottom:-18px;
                    }
                </style>
				<div class="circle"></div>

                <div class="mainconsaubos" style="background-color:
                @if($employee->position == 'Security Guard')
                    orange;
                @elseif($employee->position == 'Administrator')
                    #5ec5fc;
                @elseif($employee->position == 'Department Head')
                    @if($employee->sector == 'BSIT')
                        orange;
                    @elseif($employee->sector == 'BEED')
                        blue;
                    @else
                        green;
                    @endif
                @elseif($employee->position == 'Instructor')
                    purple;
                @else
                    transparent;
                @endif">


					<div class="main-two">
						<div class="main-name">
							<div class="name editable" contenteditable="true" id="editable-text-name">
								<h5 id="last-name" class="text-uppercase"> {{ $employee->lastname }}<br id="first-name">{{ $employee->firstname }}  {{ strtoupper(substr($employee->middlename, 0, 1)) }}.</h5>
							</div>
							<div class="brgy editable" contenteditable="true" id="editable-text-brgy">
								<p> {{ $employee->address }}</p>
							</div>
						</div>
						<div class="date editable" contenteditable="true" id="editable-text-date">
							<p>Date of birth:<br /> {{ $employee->datebirth }}</p>
						</div>
					</div>
					<div class="numcourse">
						<div class="number editable" contenteditable="true" id="editable-text-number">
							<h4> {{ $employee->employeeid }}</h4>
						</div>
						<div class="course editable" contenteditable="true" id="editable-text-course">
							<h4> {{ $employee->position }}</h4>
						</div>
					</div>
					<div class="last">
						<div class="num1">
							<p>https://mlgcl.edu.ph</p>
						</div>
						<div class="num2">
							<p>mlg@mlgcl.edu.ph</p>
						</div>
					</div>
				</div>
			</div>
            <style>
                .parag-name p{
                    margin-top:-30px;
                    font-size:8px;
                }

                .tableNo table{
                    margin-top:-10px;

                }
                .parag2{
                    margin-top:-8px;
                }
                .parag3{
                    margin-top:-25px;
                }
                .parag4 p{
                    margin-top:-23px;
                }
                .parag5{
                    margin-top:-26px;
                    height:55px;
                }
                .parag5 p{
                  margin:5px;
                }
                .likod-two{
                    height:20px;
                }
                .likod-two-last p{
                    margin:10px;
                }
            </style>
			<!-- Back of the ID -->
			<div class="likod">
				<div class="likod-one">
					<div class="one-right">
						<div class="parag">
							<p>
								This is to certify that the person whose
								<br />
								picture and signature appear herein is a <br />
								bonafide student of <br />
								<span class="parag1span">MLG College of Learning, Inc.</span>
							</p>
						</div>
						<div class="parag-name">
							<p>
								MARY LILIBETH O. YAN, DEV.ED.D
								<span>
									<br />
									School Director
								</span>
							</p>
						</div>
						<div class="tableNo">
							<table>
								<tr>
									<td>TIN #</td>
									<td class="num">292-429-675</td>
									<td>PhilHealth #</td>
									<td class="num">01-051293562-7</td>
								</tr>
								<tr>
									<td>SSS #</td>
									<td class="num">34-1976221-1</td>
									<td>HDMF #</td>
									<td class="num">1210-2944-8122</td>
								</tr>
							</table>
						</div>
						<div class="parag2">
							<p>
								<span class="span">IMPORTANT REMINDERS </span> <br />
								Always wear this ID while inside the school campus. <br />
								<span class="span1">DO NOT FORGET YOUR STUDENT ID NUMBER.</span>
							</p>
						</div>
						<div class="parag3">
							<p>
								If lost and found, please surrender this ID to the <br />
								SCHOOL DIRECTOR'S OFFICE. MLG College of Learning, <br />
								Inc. Brgy. Atabay, Hilongos, Leyte
							</p>
						</div>
						<div class="parag4" id="editable-text-parag4">
							<p>
								In case of emergency, please contact <br />
								<span class="editable" id="editable-contact">
									<span id="editable-name" contenteditable="true"> {{ $employee->ename }}</span> <br />
									<span id="editable-number" contenteditable="true"> {{ $employee->contact }}</span>
								</span>
							</p>
						</div>
						<div class="parag5">
							<p>PLEASE SCAN THE QR CODE AT THE FRONT <br />FOR MORE VALIDATION & CONTACT <br />INFORMATION.</p>
						</div>
					</div>
				</div>
				<div class="likod-two">
					<div class="likod-two-last">
						<svg width="15px" height="15px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none">
							<path
								fill="#1877F2"
								d="M15 8a7 7 0 00-7-7 7 7 0 00-1.094 13.915v-4.892H5.13V8h1.777V6.458c0-1.754
                            1.045-2.724 2.644-2.724.766 0 1.567.137 1.567.137v1.723h-.883c-.87 0-1.14.54-1.14 1.093V8h1.941l-.31 2.023H9.094v4.892A7.001 7.001 0 0015 8z"
							/>
							<path
								fill="#ffffff"
								d="M10.725 10.023L11.035 8H9.094V6.687c0-.553.27-1.093 1.14-1.093h.883V3.87s-.801-.137-1.567-.137c-1.6 0-2.644.97-2.644
                            2.724V8H5.13v2.023h1.777v4.892a7.037 7.037 0 002.188 0v-4.892h1.63z"
							/>
						</svg>
						<p>https://www.facebook.com/mlgcl/</p>
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
                <form id="createForm" action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" value="{{ old('firstname', $employee->firstname) }}">

                    <label for="middlename">Middle Name:</label>
                    <input type="text" id="middlename" name="middlename" value="{{ old('middlename', $employee->middlename) }}">

                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname" value="{{ old('lastname', $employee->lastname) }}">

                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $employee->address) }}">




                    <label for="contact">Contact number:</label>
                    <input type="text" id="contact" name="contact" value="{{ old('contact', $employee->contact) }}">

                    <label for="econtact">Emergency contact number:</label>
                    <input type="text" id="econtact" name="econtact" value="{{ old('econtact', $employee->econtact) }}">

                    <label for="position">Position:</label>
                    <input type="text" id="position" name="position" value="{{ old('position', $employee->position) }}">

                    <label for="employeeid">Employee ID:</label>
                    <input type="text" id="employeeid" name="employeeid" value="{{ old('employeeid', $employee->employeeid) }}">

                    <label for="datebirth">Date of Birth:</label>
                    <input type="date" id="datebirth" name="datebirth" value="{{ old('datebirth', $employee->datebirth) }}">

                    <label for="ename">Emergency contact person:</label>
                    <input type="text" id="ename" name="ename" value="{{ old('ename', $employee->ename) }}">

                    <label for="signature">Signature:</label>
                    <input type="file" id="signature" name="signature">
                    @if ($employee->signature)
                        <img src="{{ asset('storage/' . $employee->signature) }}" alt="QR Code" width="30%">
                        @else
                        <p>No signature code available.</p>
                    @endif

                                    <label for="qr">QR Code:</label>
                                    <input type="file" id="qr" name="qr">
                                    @if ($employee->qr)
                        <img src="{{ asset('storage/' . $employee->qr) }}" alt="QR Code" width="30%">
                    @else
                        <p>No QR code available.</p>
                    @endif

                                    <label for="proimage">Profile Image:</label>
                                    <input type="file" id="proimage" name="proimage">
                                    @if ($employee->proimage)
                        <img src="{{ asset('storage/' . $employee->proimage) }}" alt="QR Code" width="30%">
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
