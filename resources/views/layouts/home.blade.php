<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.5/lottie.min.js"></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: #BFDCDF;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            margin-top: 20px;
        }
        .container1 {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background: #F6FBF9;
            border-radius: 50px;
            box-shadow: 0px 4px 10px 1px rgba(0,0,0,0.1);
            text-align: center;
        }
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            display: flex;
            justify-content: center; /* Centrer horizontalement */
            align-items: center;
            background-color: white;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        footer {
            padding: 10px 0;
            text-align: center;
            font-size: 14px;
            margin-bottom: 10px;
           
        }

        .header img {
            width: 150px;
            height: 30px;
            margin-bottom: 7px;
        }
    </style>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
</head>
<body>
    <div class="header">  
        <!-- Logo -->
        <a href="{{ route('home') }}">
            <img src="images/logo.png" alt="Image de connexion" class="navbar-logo">
        </a>
    </div>
    <div>
        @yield('content')
    </div>
    <footer>
    <p class="text-center " style=" color: #F0F0F2
;">© 2024 SNEP, Maroc</p>
    </footer>
</body>
</html>
