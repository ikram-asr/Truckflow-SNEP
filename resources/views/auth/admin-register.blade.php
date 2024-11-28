@extends('layouts.home')
@section('content')
<div class="container1" >
    <h3 style=" font-weight: bold;">S'inscrire</h3>

    <!-- Formulaire d'inscription -->
    <form method="POST" action="{{ route('inscription') }}">
        @csrf

        <!-- Nom -->
        <div class="form-group">
            <label for="Nom" style="margin-right : 405px;">Nom :</label>
            <input type="text" id="name" name="Nom"  style="font-size: 18px;  border: 1px solid #16a085; border-radius: 5px; " class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus  placeholder="Votre nom">
            @error('name')
                <span class="invalid-feedback" role="alert" style="font-family: 'Poppins', sans-serif; font-weight: bold;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Prénom -->
        <div class="form-group">
            <label for="Prénom" style="margin-right : 385px;">Prénom :</label>
            <input  style="font-size: 18px;  border: 1px solid #16a085; 
            border-radius: 5px;" type="text" id="prenom" name="Prénom" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom') }}" required  placeholder="Votre prénom">
            @error('prenom')
                <span class="invalid-feedback" role="alert" style="font-family: 'Poppins', sans-serif; font-weight: bold;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="nom_utilisateur" style="margin-right : 310px;">Nom d'utilisateur :</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur"  style="font-size: 18px;  border: 1px solid #16a085; border-radius: 5px;"
             class="form-control " value="{{ old('nom_utilisateur') }}" required  placeholder="Votre nom d'utilisateur">
        </div>

        <!-- Mot de passe -->
        <div class="form-group">
            <label for="Motdepasse"style="margin-right : 340px;" >Mot de passe :</label>
            <input type="password" id="password" name="password"  style="font-size: 18px;  border: 1px solid #16a085; border-radius: 5px;" class="form-control @error('password') is-invalid @enderror" required placeholder="Votre mot de passe">
            @error('password')
                <span class="invalid-feedback" role="alert" >
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Confirmation du mot de passe -->
        <div class="form-group">
            <label for="password-confirm" style="margin-right : 250px;">Confirmer mot de passe :</label>
            <input type="password" id="password-confirm" name="password_confirmation"   style="font-size: 18px;  border: 1px solid #16a085; border-radius: 5px;" class="form-control" required  placeholder="Confirmer mot de passe">
        </div> <br>

        <!-- Bouton d'inscription -->
        <button type="submit" class="btn btn-primary" style="color: #fff; width: 250px; padding-left: 0px; background: #84C7AE; border: 0px; cursor: pointer; font-family: 'Poppins', sans-serif; ">
            S'inscrire
        </button> <br>

        <!-- Lien pour connexion -->
        @if (Route::has('loginadmin'))
            <span ">Vous avez déjà un compte ?</span>
            <a class="btn btn-link" href="{{ route('loginadmin') }}" style="color: #16a085; ">
                Connectez-vous
            </a>
        @endif
    </form>
    </div>
@endsection