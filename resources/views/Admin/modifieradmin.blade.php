@extends('layouts.app')
@section('content')
<div class="container1" style="width: 100%; max-width: 800px; margin: auto;">
    <h3 style="font-weight: bold;">Modifier les données de l'admin</h3>
    <form action="{{ route('modifieradmin', $admin->id) }}" method="POST"> 
    @csrf
    @method('PUT')
        <div class="form-group row mb-2">
            <label for="Nom" class="col-sm-4 col-form-label text-right">Nom :</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="Nom" value="{{ $admin->Nom }}"
            name="Nom " >
        </div>
        <div class="form-group row mb-2">
            <label for="Prénom" class="col-sm-4 col-form-label text-right">Prénom :</label>
            <div class="col-sm-8">
                <input type="text" id="Prénom" 
                name="Prénom" value="{{ $admin->Prénom }}"  class="form-control">
                    <span class="invalid-feedback" role="alert">
                    </span>
            </div>
        </div>
    


        <div class="form-group row mb-2">
            <label for="nom_utilisateur" class="col-sm-4 col-form-label text-right">Nom d'utilisateur :</label>
            <div class="col-sm-8">
                <input type="text" id="nom_utilisateur" name="nom_utilisateur" value="{{ $admin->nom_utilisateur }}"  class="form-control" placeholder="CIN">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label for="password" class="col-sm-4 col-form-label text-right">Mot de passe :</label>
            <div class="col-sm-8">
                <input type="password" id="password" name="password" value="{{ $admin->password }}"  class="form-control" >
            </div>
        </div>
        <!-- Bouton d'inscription -->
        <div class="form-group row mb-2">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary" style="color: #fff; width: 250px; background: #84C7AE; border: 0px; cursor: pointer;">
                    Modifier
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
