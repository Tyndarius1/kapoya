
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>

    <style>
* {
    margin: 0;
    padding: 0;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    font-family: Arial, sans-serif;
}

.main-container {
    display: flex;
    flex-direction: column;
    width: 260px;
    height: 380px;
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}


.main-one {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.main-two {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 40px 8px;
    color: whitesmoke;
}

.numcourse {
    display: flex;
    background: white;
    position: absolute;
    bottom: 15%;
    height:20px;
    padding-right: 100%;
    font-size: 13px;
}


.course h4 {
    position: absolute;
    right: 5px;
    top: 15%;
}

.number h4{
    position: absolute;
    left: 5px;
    top: 15%;
}

.last {
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: absolute;
    top:85%;
    gap: 80%;
    margin: 6px;
}

.logo {
    text-align: center;
    margin: 10px 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    text-align: center;
   position: absolute;
   left: 0px;
}


.logo img {
    width: 45px;
    height:45px;
    margin-bottom: 0;
}

.logo p {
    font-size: 6px;
}

.qr-code img {
    width: 85px;
    height: 85px;
    position: absolute;
    top: 23%;
    left: 3%;
}

.signature img {
    width: 40%;
    height: 40;
    position: absolute;
    top: 45%;
    left: 0;
}

.image img {
    width: 250px;
    height: 250px;
    position: absolute;
    left: 20%;
    top: 2%;
}

.image-container {
    width: 250px;
    height: 250px;
    position: relative;
    left: 20%;
    top: 2%;
    overflow: hidden;
    border: 1px dashed #ccc;
}

#editable-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.main-name .name {
    text-transform: uppercase;
    text-align: right;
}

.date p {
    font-size: 10px;
    position: absolute;
    bottom: 45px;
}

.brgy p {
    font-size: 10px;
    position: absolute;
    bottom: 45px;
    right: 5px;
}

.last p {
    font-size: 10px;
    display: flex;
    justify-content: space-between;
}

.mainconsaubos {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 150px;
    background: #ff6f00;
    clip-path: polygon(0% 30%, 100% 0%, 100% 100%, 0% 100%);
}

.num2 {
    position: absolute;
    left: 160px;
}

.print-button {
    background-color: #007BFF;
    color: white;
    padding: 10px 20px;
    border: 2px solid #007BFF;
    border-radius: 5px;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    text-transform: uppercase;
    transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
    position: absolute;
    left: 20px;
    top: 20px;
}

.print-button:hover {
    background-color: #0056b3;
    border-color: #0056b3;
    color: #f0f0f0;
}

.print-button:focus {
    outline: none;
    box-shadow: 0 0 3px rgba(0, 123, 255, 0.6);
}


</style>

</head>
<body>



    <button class="print-button" onclick="printIdCard()">Print</button>

<div id="content">
<div class="pinakamain">
        <div class="main-container">
            <div class="main-one">
                <div class="one">
                    <div class="logo">
                        <img src="{{asset('img/mlg.png')}}" alt="MLG Logo">
                        <div class="mlg-name">
                        <p class="mlg">MLG COLLEGE<br>OF LEARNING, INC</p>
                        <p class="barag">Brgy. Atabay, Hilongos, Leyte</p>
                    </div>
                    </div>
                    <div class="qr-code">
                        <img id="qr-code" src="{{ asset('img/qr.png')}}" alt="Student QR Code">
                    </div>
                    <div class="signature" >
                    @if ($student->signature)
                    <img src="{{ asset('storage/' . $student->signature) }}" alt="QR Code" width="30%" id="draggableImageSignature">
                    @else
                        <p>No signature available.</p>
                    @endif
                    </div>
                    <div class="main-image">
                        <div class="image">
                        @if ($student->proimage)
                            <img src="{{ asset('storage/' . $student->proimage) }}" alt="QR Code" width="30%" id="draggableImage">
                        @else
                            <p>No qr code available.</p>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="mainconsaubos"
            style="background-color:
                @if($student->course == 'BSIT')
                    orange;
                @elseif($student->course == 'BEED') #5ec5fc;
                @elseif($student->course == 'BSED-Math')
                    green;
                @elseif($student->course == 'BSED-SS')
                    purple;
                @else
                    transparent;
                @endif">
    <div class="main-two">
        <div class="date editable" contenteditable="true" id="editable-text-date">
            <p>Date of birth:<br>{{ $student->datebirth }}</p>
        </div>
        <div class="main-name">
            <div class="name editable" contenteditable="true" id="editable-text-name">
                <h3 class="text-uppercase">{{ $student->lastname }}<br class="text-uppercase">{{ $student->firstname }} {{ strtoupper(substr($student->middlename, 0, 1)) }}.</h3>
            </div>
            <div class="brgy editable" contenteditable="true" id="editable-text-brgy">
                <p>{{ $student->address }}</p>
            </div>
        </div>
    </div>

    <div class="numcourse">
        <div class="number">
            <h4 id="student-id"> {{ $student->studentid }}</h4>
        </div>
        <div class="course">
            <h4> {{ $student->course }}</h4>
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
    </div>
</div>




        <script>
            const apiKey = '{{ (config('system.api_key')) }}'; // Verify this renders correctly
            const studentId = document.getElementById('student-id').textContent.trim(); // Ensure no extra spaces
            console.log('Student ID:', studentId);

            fetch(`https://api-portal.mlgcl.edu.ph/api/external/student-list`, {
                method: 'GET',
                headers: {
                    'Origin': 'http://idmaker.test',
                    'x-api-key': apiKey,
                    'Content-Type': 'application/json'
                },
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(HTTP error! status: ${response.status} ${response.statusText});
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Fetched data:', data);

                    const student = data.data.find(student =>
                        student.student_identification_number.some(id => id.student_id === studentId)
                    );

                    if (student) {
                        console.log('Student data:', student);
                        const qrCodeImg = document.getElementById('qr-code');
                        qrCodeImg.src = student.qr_code || ''; // Ensure the QR code URL exists
                        qrCodeImg.alt = "QR Code for " + student.student_identification_number;
                    } else {
                        console.error('Student with the specified ID not found.');
                    }
                })
                .catch(error => {
                    console.error('Error fetching students:', error);
                });
        </script>




<script>
    function printIdCard() {
        var content = document.getElementById('content').innerHTML;
        var originalContent = document.body.innerHTML;

        // Replace body content with the ID card content
        document.body.innerHTML = content;
        window.print();

        // Restore original content after printing
        document.body.innerHTML = originalContent;
    }
</script>



</body>
</html>
