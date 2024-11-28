<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css" rel="stylesheet">
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
        }
        table {
            display: block;
            height: 400px;
            overflow-y: auto;
        }
        .container1 {
            width: 100%;
            max-width: 1100px;
            max-height: 740px;
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
            z-index: 1000; /* Pour s'assurer que l'image reste au-dessus des autres éléments */
            display: flex;
            align-items: center;
            background-color: white;
            padding: 10px 20px; /* Ajustez selon vos besoins */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Optionnel : pour un léger effet de shadow */
            flex-wrap: nowrap; /* Empêche le retour à la ligne */
            justify-content: space-between;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .user-info {
            display: flex;
            align-items: center;
        }
        .logout {
            margin-left: 20px;
        }
        @media (max-width: 768px) {
            .header {
                padding: 10px; /* Ajustez le padding si nécessaire */
            }
            .user-info {
                display: flex;
                align-items: center;
            }
            .logout {
                margin-left: 20px;
            }
        }
        .readonly-input {
            background-color: #e9ecef; /* Couleur de fond grise */
            cursor: not-allowed; /* Changer le curseur pour indiquer que le champ est non modifiable */
        }
    </style>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
</head>
<body>
    <div class="header d-flex align-items-center">
        <!-- Logo -->
        <a href="{{ route('acceuil') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </a>
        <!-- Espace pour le nom de l'utilisateur -->
        <div class="user-info d-flex align-items-center">
           <span style="margin-right: 5px;">Bonjour </span>  
        @auth('admin')
                <span class="me-3">{{ Auth::guard('admin')->user()->Nom }} 
                {{ Auth::guard('admin')->user()->Prénom }}
                </span>
            @endauth
            @auth('agent')
                <span class="me-3">{{ Auth::guard('agent')->user()->Nom }}
                {{ Auth::guard('agent')->user()->Prenom }}
                </span>
            @endauth
        </div>
        <!-- Bouton de déconnexion -->
        <div class="logout">
            <form id="logout-form" action="{{ route('logoutadmin') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" class="d-flex align-items-center" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16" style="color: black;">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                </svg>
            </a>
        </div>
    </div>
    <div class=" mt-5 pt-5">
        @yield('content')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>

