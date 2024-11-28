@extends('layouts.app')
@section('content')
<div class="container1" style="width: 100%; max-width: 800px; margin: auto; margin-top:50px;">
    <h3 style="font-weight: bold;">Modifier les données du camion</h3>
    <form action="{{ route('modifiercamion', $camion->IdPassage) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- Id Passage -->
        <div class="form-group row mb-2">
            <label for="IdPassage" class="col-sm-4 col-form-label text-right">ID Passage :</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="IdPassage" value="{{ $camion->IdPassage }}"
            name="IdPassage" readonly >
        </div>

        <!-- Immatriculation -->
        <div class="form-group row mb-2">
            <label for="Immatriculation" class="col-sm-4 col-form-label text-right">Immatriculation :</label>
            <div class="col-sm-8">
                <input type="text" id="Immatriculation" name="Immatriculation" value="{{ $camion->Immatriculation }}" class="form-control">
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>

        <!-- Chauffeur CIN -->
        <div class="form-group row mb-2">
            <label for="Cin_transporteur" class="col-sm-4 col-form-label text-right">Chauffeur :</label>
            <div class="col-sm-8">
                <input type="text" value="{{ $camion->Cin_transporteur }}" id="Cin_transporteur" name="Cin_transporteur" class="form-control" placeholder="CIN">
            </div>
        </div>

        <!-- Chauffeur Nom et Prénom -->
        <div class="form-group row mb-2">
            <div class="col-sm-6">
                <input type="text" value="{{ $camion->Nom_transporteur }}" id="Nom_transporteur" name="Nom_transporteur" class="form-control" placeholder="Nom">
            </div>
            <div class="col-sm-6">
                <input type="text" id="Prenom_transporteur" value="{{ $camion->Prenom_transporteur }}" name="Prenom_transporteur" class="form-control" placeholder="Prénom">
            </div>
        </div>

        <!-- Type véhicule -->
        <div class="form-group row mb-2">
            <label for="Type" class="col-sm-4 col-form-label text-right">Type de véhicule :</label>
            <div class="col-sm-8">
                <select id="Type" name="Type" class="form-control">
                    @foreach($types_vehicule as $type)
                        <option value="{{ $type->Type }}" @if($camion->Type == $type->Type) selected @endif>
                            {{ $type->Type }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

<!-- Opération -->
<div class="form-group row mb-2">
    <label for="Operation" class="col-sm-4 col-form-label text-right">Opération :</label>
    <div class="col-sm-8">
        <select id="Operation" name="Operation" class="form-control">
            <option value="Chargement" @if($camion->Operation == 'Chargement') selected @endif>Chargement</option>
            <option value="Déchargement" @if($camion->Operation == 'Déchargement') selected @endif>Déchargement</option>
        </select>
    </div>
</div>


        <!-- Heure d'enregistrement -->
        <div class="form-group row mb-2">
            <label for="heure_enregistrement" class="col-sm-4 col-form-label text-right">Heure d'enregistrement :</label>
            <div class="col-sm-8">
                <input type="text" id="heure_enregistrement" name="heure_enregistrement" class="form-control" value="{{ $camion->heure_enregistrement }}" readonly required autofocus>
                @error('heure_enregistrement')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <!-- NumeroBl hidden -->
        <div class="form-group row mb-2">
   	
        @if(is_null($camion->Numero_Bl))
            <button disabled type="submit" class="btn btn-danger p-0" style="width: 0px; height: 30x; border: 0; cursor: pointer;">
            </button>       
        @else
        <form action="{{ route('supprimerbl', $camion->IdPassage) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer l'heure de sortie du camion ?');" class="mr-2">
            @csrf
            
            <button type="submit" class="btn btn-danger p-0" style="width: 0px; height: 0px; border: 0; cursor: pointer;">
            </button>
        </form>        @endif


    </div>


<div class="form-group row mb-2">
    <label for="Numero_Bl" class="col-sm-4 col-form-label text-right">Numéro de Bl :</label>
    <div class="col-sm-8 d-flex align-items-center">


        <!-- Champ de saisie -->
		
        @if(is_null($camion->Numero_Bl))
            <input type="text" id="Numero_Bl" name="Numero_Bl" class="form-control" placeholder="Numéro de Bl" disabled>
        @else
            <input type="text" id="Numero_Bl" name="Numero_Bl" class="form-control @error('Numero_Bl') is-invalid @enderror" value="{{ $camion->Numero_Bl }}" readonly required autofocus>
        @endif
		        <!-- Formulaire de suppression -->
        @if(is_null($camion->Numero_Bl))

            <button  disabled type="submit" class="btn btn-danger p-0" style="width: 50px; height: 38px; border: 0; cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                </svg>
            </button>
        @else
        <form action="{{ route('supprimerbl', $camion->IdPassage) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer le Numéro de BL du camion ?');" class="mr-2">
            @csrf
            
            <button type="submit" class="btn btn-danger p-0" style="width: 50px; height: 38px; border: 0; cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                </svg>
            </button>
        </form>        @endif

    </div>
</div>


<!-- Heure de sortie -->
<div class="form-group row mb-2">
    <label for="heure_sortie" class="col-sm-4 col-form-label text-right">Heure de sortie :</label>
    <div class="col-sm-8 d-flex align-items-center">


        <!-- Champ de saisie -->
        @if(is_null($camion->heure_sortie))
            <input type="text" id="heure_sortie" name="heure_sortie" class="form-control" placeholder="Heure de sortie" disabled>
        @else
            <input type="text" id="heure_sortie" name="heure_sortie" class="form-control @error('heure_sortie') is-invalid @enderror" value="{{ $camion->heure_sortie }}" readonly required autofocus>
        @endif
		        <!-- Formulaire de suppression -->
        @if(is_null($camion->heure_sortie))

            <button  disabled type="submit" class="btn btn-danger p-0" style="width: 50px; height: 38px; border: 0; cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                </svg>
            </button>
        @else
        <form action="{{ route('supprimersortie', $camion->IdPassage) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer l'heure de sortie du camion ?');" class="mr-2">
            @csrf
            
            <button type="submit" class="btn btn-danger p-0" style="width: 50px; height: 38px; border: 0; cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                </svg>
            </button>
        </form>        @endif

    </div>
</div>


        <!-- Bouton de modification -->
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
