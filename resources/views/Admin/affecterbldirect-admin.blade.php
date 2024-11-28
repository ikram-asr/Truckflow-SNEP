@extends('layouts.app')
@section('content')

<div class="container1" style="width: 100%; max-width: 800px; margin: auto;">
    <h3 style="font-weight: bold;">Affecter un BL</h3>

    @if (is_null($camion))
    <form action="{{ route('bonliv') }}" method="GET"> 
        @csrf
        <div class="form-group row mb-2">
            <label for="IdPassage" class="col-sm-4 col-form-label text-right">ID Passage :</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="IdPassage" value=""
            name="IdPassage" >
        </div>
        <!-- Bouton pour soumettre le formulaire -->
        <div class="form-group row mb-2">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary" style="margin-top:20px; color: #fff; width: 250px; background: #84C7AE; border: 0px; cursor: pointer;">
                    Rechercher
                </button>
            </div>
        </div>
    </form>
    @elseif ($camion && is_null($camion->Numero_Bl))
    <form action="{{ route('affecterbld') }}" method="POST">
        @csrf
 
        <div class="form-group row mb-2">
            <label for="IdPassage" class="col-sm-4 col-form-label text-right">ID Passage :</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="IdPassage" value="{{ $camion->IdPassage }}"
            name="IdPassage" readonly >
        </div>
        
        <!-- Immatriculation -->
        <div class="form-group row mb-2">
            <label for="Immatriculation" class="col-sm-4 col-form-label text-right">Immatriculation</label>
            <div class="col-sm-8">
                <input type="text" id="Immatriculation" name="Immatriculation" value="{{ $camion->Immatriculation }}" readonly class="form-control">
            </div>
        </div>
        <!-- Informations du chauffeur -->
        <div class="form-group row mb-2">
            <label for="Cin_transporteur" class="col-sm-4 col-form-label text-right">Chauffeur :</label>
            <div class="col-sm-8">
                <input type="text" id="Cin_transporteur" name="Cin_transporteur" value="{{ $camion->Cin_transporteur }}" readonly class="form-control" placeholder="CIN">
            </div>
        </div>
        <div class="form-group row mb-2">
            <div class="col-sm-6">
                <input type="text" value="{{ $camion->Nom_transporteur }}" id="Nom_transporteur" readonly name="Nom_transporteur" class="form-control" placeholder="Nom">
            </div>
            <div class="col-sm-6">
                <input type="text" value="{{ $camion->Prenom_transporteur }}" id="Prenom_transporteur" readonly name="Prenom_transporteur" class="form-control" placeholder="Prénom">
            </div>
        </div>
        <!-- Type de véhicule -->
        <div class="form-group row mb-2">
            <label for="Type" class="col-sm-4 col-form-label text-right">Type de véhicule :</label>
            <div class="col-sm-8">
                <input type="text" id="Type" value="{{ $camion->Type }}" readonly name="Type" class="form-control" placeholder="Type de véhicule">
            </div>
        </div>
        <!-- Opération -->
        <div class="form-group row mb-2">
            <label for="Operation" class="col-sm-4 col-form-label text-right">Opération :</label>
            <div class="col-sm-8">
                <input type="text" id="Operation" value="{{ $camion->Operation }}" readonly name="Operation" class="form-control" placeholder="Opération">
            </div>
        </div>
        <!-- Heure d'enregistrement -->
        <div class="form-group row mb-2">
            <label for="heure_enregistrement" class="col-sm-4 col-form-label text-right">Heure d'enregistrement :</label>
            <div class="col-sm-8">
                <input type="text" id="heure_enregistrement" name="heure_enregistrement" class="form-control" value="{{ $camion->heure_enregistrement }}" readonly required autofocus>
            </div>
        </div>
        <!-- Numero BL -->
        <div class="form-group row mb-2">
            <label for="Numero_Bl" class="col-sm-4 col-form-label text-right">Numero de BL :</label>
            <div class="col-sm-8">
                <input type="text" id="Numero_Bl" name="Numero_Bl" class="form-control" required placeholder="Numero BL">
            </div>
        </div>
                <div class="form-group row mb-2">
            <label for="heure_enregistrement" class="col-sm-4 col-form-label text-right">Heure d'affectation de BL :</label>
            <div class="col-sm-8">
                <input type="text" id="heure_affectation_bl"  
                name="heure_affectation_bl" class="form-control readonly-input " value="" readonly 
                required autofocus >
            </div>
        </div>
		@if ($errors->any())
    <div class="alert alert-danger">
       
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        
    </div>
@endif

		
        <!-- Bouton d'inscription -->
        <div class="form-group row mb-2">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary" style="color: #fff; width: 250px; background: #84C7AE; border: 0px; cursor: pointer;">
                    Affecter
                </button>
            </div>
        </div>
    </form>
    @else
    <div class="alert alert-danger" role="alert">Entrer un ID de Passage valide</div>
    <form action="{{ route('bonlivraison') }}" method="GET">
        @csrf
        <!-- Id Passage   -->
        <div class="form-group row mb-2">
            <label for="IdPassage" class="col-sm-4 col-form-label text-right">ID Passage :</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="IdPassage" value=""
            name="IdPassage" >
        </div>
        <!-- Bouton pour soumettre le formulaire -->
        <div class="form-group row mb-2">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary" style="margin-top:20px; color: #fff; width: 250px; background: #84C7AE; border: 0px; cursor: pointer;">
                    Rechercher
                </button>
            </div>
        </div>
    </form>
    @endif
    <script>
    async function fetchMoroccoTime() {
        try {
            // Aller chercher l'heure du Maroc sur internet
            const response = await fetch('http://worldtimeapi.org/api/timezone/Africa/Casablanca');
            const data = await response.json();

            // Extraire la date et l'heure
            const dateTime = new Date(data.datetime);

            // Formater l'heure du Maroc
            var hours = dateTime.getHours().toString().padStart(2, '0');
            var minutes = dateTime.getMinutes().toString().padStart(2, '0');
            var seconds = dateTime.getSeconds().toString().padStart(2, '0');

            // Créer la chaîne d'heure
            var timeString = `${hours}:${minutes}:${seconds}`;

            // Obtenir la date actuelle du système
            var now = new Date();
            var day = now.getDate().toString().padStart(2, '0');
            var month = (now.getMonth() + 1).toString().padStart(2, '0'); // Les mois commencent à 0
            var year = now.getFullYear();

            // Combiner la date du système avec l'heure du Maroc
            var fullDateTimeString = `${day}/${month}/${year} ${timeString}`;

            // Mettre à jour le champ input avec la date du système et l'heure du Maroc
            document.getElementById('heure_affectation_bl').value = fullDateTimeString;

        } catch (error) {
            console.error("Oops, problème pour récupérer l'heure du Maroc ! 😅", error);
        }
    }

    // Mettre à jour chaque seconde
    setInterval(fetchMoroccoTime, 1000);

    // Initialiser l'heure au chargement
    fetchMoroccoTime();
</script>

</div>

@endsection
