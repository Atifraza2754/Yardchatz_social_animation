<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map Design</title>
    <!-- Favicon for the Title Bar -->
   {{--  <link rel="icon" href="{{ asset('assets/img/live-apple.png') }}" width="80px" height="80px" type="image/png">
 --}}
     <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-w76A24a7KoHvjG3ROz5oGzeyPpC1qjErqa2i1p5H5vD0Dlj1k5FMOe3iqwosSI3K" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/js/app.js']) {{-- ya jo bhi tumhara entry point ho --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/page-flip/dist/css/page-flip.css">
       <link rel="stylesheet" href="{{asset('assets/css/call_receive_modal.css')}}">

</head>
<body class="main-bakground-img">