
    <title>Welcome</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href=" {{ asset('css/navbar.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>





</head>
<body>

@include('layouts.nav')
@yield('content')