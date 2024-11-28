@extends('layouts.app')
@section('content')
<div class="container1" >
    <h3 style=" font-weight: bold;">Inscrie un nouvel agent</h3>

    <!-- Formulaire d'inscription -->
    <form method="POST" action="{{ route('inscrire') }}">
        @csrf

        <!-- Nom -->
        <div class="form-group">
            <label for="Nom" style="margin-right : 405px;">Nom :</label>
            <input type="text" id="Nom" name="Nom" style="font-size: 18px; border: 1px solid #16a085; border-radius: 5px;" class="form-control @error('Nom') is-invalid @enderror" value="{{ old('Nom') }}" required autofocus placeholder="Votre nom">
            @error('Nom')
                <span class="invalid-feedback" role="alert" style="font-family: 'Poppins', sans-serif; font-weight: bold;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Prénom -->
        <div class="form-group">
            <label for="Prenom" style="margin-right : 385px;">Prénom :</label>
            <input type="text" id="Prenom" name="Prenom" style="font-size: 18px; border: 1px solid #16a085; border-radius: 5px;" class="form-control @error('Prenom') is-invalid @enderror" value="{{ old('Prenom') }}" required placeholder="Votre prénom">
            @error('Prenom')
                <span class="invalid-feedback" role="alert" style="font-family: 'Poppins', sans-serif; font-weight: bold;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Nom d'utilisateur -->
        <div class="form-group">
            <label for="nomutilisateur" style="margin-right : 310px;">Nom d'utilisateur :</label>
            <input type="text" id="nomutilisateur" name="nomutilisateur" style="font-size: 18px; border: 1px solid #16a085; border-radius: 5px;" class="form-control @error('nomutilisateur') is-invalid @enderror" value="{{ old('nomutilisateur') }}" required placeholder="Votre nom d'utilisateur">
            @error('nomutilisateur')
                <span class="invalid-feedback" role="alert" style="font-family: 'Poppins', sans-serif; font-weight: bold;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Mot de passe -->
        <div class="form-group">
            <label for="password" style="margin-right : 340px;">Mot de passe :</label>
            <input type="password" id="password" name="password" style="font-size: 18px; border: 1px solid #16a085; border-radius: 5px;" class="form-control @error('password') is-invalid @enderror" required placeholder="Votre mot de passe">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <br>

		        <!-- Role 

		    <div class="form-group">
        <label for="role">Rôle</label>
        <select name="role" id="role" class="form-control">
            <option value="agent">Utilisateur</option>
            <option value="admin">Administrateur</option>
        </select>
    </div>-->
        <!-- Bouton d'inscription -->
        <button type="submit" class="btn btn-primary" style="color: #fff; width: 250px; padding-left: 0px; background: #84C7AE; border: 0px; cursor: pointer; font-family: 'Poppins', sans-serif;">
            Inscrire
        </button> 
    </form>
</div>
@endsection
