@extends('layouts.home')
@section('content')
<div class="container1">
    <h3 style=" font-weight: bold;">Se connecter</h3>

    <!-- Formulaire de connexion  }}-->
    <form method="POST" action="{{ route('loginagent') }}">
        @csrf
        <!-- Afficher les alertes d'erreur -->
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <!-- Email -->
        <div class="form-group">
            <label for="nomutilisateur" style="margin-right : 310px;">Nom d'utilisateur :</label>
            <input type="text" id="nomutilisateur" name="nomutilisateur" class="form-control " value="{{ old('nomutilisateur') }}" required autofocus 
            style="font-size: 18px;  border: 1px solid #16a085; border-radius: 5px;" placeholder="Votre Nom d'utilisateur">
            
        </div>

        <!-- Mot de passe -->
        <div class="form-group">
            <label for="password" style="margin-right : 340px;">Mot de passe :</label>
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required 
            style="font-size: 18px;  border: 1px solid #16a085; border-radius: 5px;" placeholder="Votre mot de passe"">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

<br>
         
        <button type="submit" class="btn " style="color: #fff; width:250px; 
        padding-left: 0px; background: #0299A7; border: 0px; cursor: pointer; "
        onmouseover="this.style.background='#027a85';"
        onmouseout="this.style.background='#0299A7';">
            Se connecter
        </button> <br>


    </form>

    </div>
@endsection
