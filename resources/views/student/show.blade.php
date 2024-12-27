@extends('layouts.header')

@section('content')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{asset('css/custom.css')}}">
<style>
    .card-body{
        display:flex;
        align-items:center;
        justify-content:center;
        gap:20px;
     
    }
    .card{
        border:none;
    }
    .id-card-canvas{
        border-radius:10px;
    }
</style>
   
  <div class="card mt-4">
            <div class="card-body" id="canvas-container">
                <div class="id-card-canvas front-side"style="background: url('{{ asset('img/boy.png') }}')">
                    <div id="logo-container">
                        <img id="school-logo" src="{{asset('img/mlg.png')}}" alt="mlg-logo" >
                        <p class="school-name">MLG COLLEGE OF LEARNING, INC.</p>
                        <p class="school-address">Brgy. Atabay, Hilongos,Leyte</p>
                    </div>
                    <div id="qr-code">
                    <img src="{{ asset('img/qr.png') }}" alt="QR Code" width="30%">
                    </div>

                    <div id="signature">
                    <img src="{{ asset('img/sig.png') }}" alt="Signature" width="50%">
                    </div>
                    <div id="course-color"style="background-color: 
                        @if ($student->course === 'BSIT') orange 
                        @elseif ($student->course === 'BEED') #5ec5fc 
                        @elseif ($student->course === 'BSED-MATH') green 
                        @elseif ($student->course === 'BSED-SS') purple 
                        @else grey 
                        @endif;">>
                        <div id="student-name">
                        <h3 id="Text-resize"class="first-name text-uppercase">{{ $student->lastname }}</h3>
                            <h2 class="last-name text-uppercase">{{ $student->firstname }} {{ strtoupper(substr($student->middlename, 0, 1)) }}.</h2>                     
    
                            <div class="extra-details">
                                <div class="dob">
                                    <p class="my-0">Date of Birth:</p>
                                    <h4>{{ $student->datebirth }}</h4>
                                </div>
                                <div class="address">
                                    <p>{{ $student->address }}</p>
                                </div>
                            </div>
                        </div>  
                        <div id="white-bar">
                            <div class="id-number">
                            {{ $student->studentid }}
                            </div>
                            <div class="course-code">
                            {{ $student->course }}
                            </div>
                        </div>
                        <div id="id-card-footer">
                            <div class="website">
                                https://mlgcl.edu.ph/
                            </div>
                            <div class="email">
                                mlg@mlgcl.edu.ph
                            </div>
                        </div>
                    </div>
                </div>
                <div class="id-card-canvas back-side">
                    <div class="validity-table ml-3" style=" margin-left:12px;">
                        <div class="row bg-white">
                            <div class="col-3">
                                <div class="row bg-black" style="display: flex;flex-direction: column;align-items: stretch;">
                                    <div class="border pl-4 text-uppercase" style="flex: 0 0 25px;display: flex;align-items: center;">
                                        Semester
                                    </div>
                                    <div class="border bg-white  pl-4 text-uppercase" style="color: black">
                                        First
                                    </div>
                                    <div class="border bg-white pl-4 text-uppercase" style="color: black">
    
                                        Second
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="row bg-black">
                                    <div class="col-12 border text-center text-uppercase p-1" >School Year</div>
                                  
                                </div>
                                <div class="row bg-black">
                                    <div class="col-3 border text-center" id="year-1" style="color: white">2021-2022</div>
                                    <div class="col-3 border text-center" id="year-2" style="color: white">2022-2023</div>
                                    <div class="col-3 border text-center" id="year-3" style="color: white">2023-2024</div>
                                    <div class="col-3 border text-center" id="year-4" style="color: white">2024-2025</div>
                                </div>
                                <div class="row bg-white">
                                    <div class="col-3 border" id="year-1" style="color: black">1</div>
                                    <div class="col-3 border" id="year-2" style="color: black">2</div>
                                    <div class="col-3 border" id="year-3" style="color: black">3</div>
                                    <div class="col-3 border" id="year-4" style="color: black">4</div>
                                </div>
                                <div class="row bg-white">
                                    <div class="col-3 border" id="year-1" style="color: black">1</div>
                                    <div class="col-3 border" id="year-2" style="color: black">2</div>
                                    <div class="col-3 border" id="year-3" style="color: black">3</div>
                                    <div class="col-3 border" id="year-4" style="color: black">4</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row back-side-blurb text-center">
    
                        <div class="offset-3 col-9 text-dark px-3">
    
                            <div class="certify-box mt-3 px-1">
                                This is to certify that the person <br> whose picture and signature appear<br> herein is a bonafide student of<br><strong>MLG College of Learning, Inc.</strong>
                            </div>
                            <div class="director-signature mt-4">
                                <img src="" alt="" class="e-signature">
                                <h6 class="mb-0" id="director-name"><strong>MARY LILIBETH O. YAN, DEV.ED. D.</strong></h6>
                                <p class="mb-0"><small>School Director</small></p>
                            </div>
                            <div class="important-reminders mt-2">
                                <h6 class="text-uppercase mb-0"><strong>Important Reminders</strong></h6>
                                <p class="mb-0">Always wear this ID while inside the school campus.</p>
                                <p class="mb-0 font-weight-bold"><strong>Do not forget your <br>STUDENT ID NUMBER.</strong></p>
                            </div>
                            <div class="if-lost-box mt-2">
                                <small>If lost and found, please surrender <BR> this ID to the</small>
                                <p class="mb-0 text-uppercase font-weight-bold">Student Affairs Office,</p>
                                <p class="mb-0">MLG College of Learning, Inc</p>
                                <p class="mb-0">Brgy. Atabay, Hilongos, Leyte</p>
                            </div>
                            <div class="emergency-contact mt-2">
                                <strong>In case of emergency,<br> please contact</strong>
                                <h5 class="mb-0 text-uppercase"><strong>{{ $student->ename }}</strong></h5>
                                <h5 class="mb-0"><strong>{{ $student->contact }}</strong></h5>
                            </div>
                            <div class="qr-scan-box bg-black text-uppercase text-white p-3 m-2">
    
                                <small>Please scan the QR <br> Code at the Front for<br> more validation & <br> Contact Information.</small>
    
                            </div>
                        </div>
                    </div>

                    <style>
                        .back-side-footer{
                            border-bottom-left-radius: 10px;
                            border-bottom-right-radius: 10px;
                        }
                    </style>
                    <div class="back-side-footer bg-black text-center py-1">
                        https://www.facebook.com/mlgcl
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
    
                function updateFontSize() {
                    var $element = $('#Text-resize'); // The name ID
    
                    // Get the text content and remove extra spaces
                    var text = $element.text().replace(/\s+/g, ' ').trim();
    
                    // Set the font size based on the length of the text
                    $element.css('font-size', text.length === 18 ? '15px' : '15px');
                }
    
                // Call the function initially and whenever the content changes
                updateFontSize();
                $('#Text-resize').on('input', updateFontSize);
            });
        </script>

<script src="{{ asset('js/app.js') }}"></script>
    
@endsection