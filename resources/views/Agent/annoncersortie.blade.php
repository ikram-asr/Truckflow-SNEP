@extends('layouts.canva')
@section('content')
<div class="container1" style="width: 100%; max-width: 800px; margin: auto; margin-top:43px;">
    <h3 style="font-weight: bold;">Annoncer la sortie du camion </h3>
        <form action="{{ route('annoncersortie', ['IdPassage' => $camion->IdPassage]) }}" method="POST">
        @csrf

        <!-- Id Passage   -->
        <div class="form-group row mb-2">
            <label for="IdPassage" class="col-sm-4 col-form-label text-right">ID de Passage</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="IdPassage" value="{{ $camion->IdPassage }}"
            name="IdPassage "readonly >
        </div>
        <!-- Immatriculation -->
        <div class="form-group row mb-2">
            <label for="Immariculation" class="col-sm-4 col-form-label text-right">Immatriculation :</label>
            <div class="col-sm-8">
                <input type="text" id="Immatricluation" 
                name="Immatriculation"value="{{ $camion->Immatriculation }}" readonly class="form-control">
                    <span class="invalid-feedback" role="alert">
                    </span>
            </div>
        </div>
    
        <div class="form-group row mb-2">
            <label for="Cin_transporteur" class="col-sm-4 col-form-label text-right">Chauffeur :</label>
            <div class="col-sm-8">
                <input type="text" value="{{ $camion->Cin_transporteur }}"
                id="chauffeur_cin" name="Cin_transporteur" readonly class="form-control" placeholder="CIN">
            </div>
        </div>

        <div class="form-group row mb-2">
            <div class="col-sm-6">
                <input type="text" value="{{ $camion->Nom_transporteur }}"
                id="chauffeur_first_name" readonly name="Nom_transporteur" class="form-control" placeholder="Nom">
            </div>
            <div class="col-sm-6">
                <input type="text" id="chauffeur_last_name" value="{{ $camion->Prenom_transporteur }}"
                readonly name="Prenom_transporteur" class="form-control" placeholder="Prénom">
            </div>
        </div>

        <!-- Type véhicule -->
        <div class="form-group row mb-2">
            <label for="Type" class="col-sm-4 col-form-label text-right">Type de véhicule :</label>
            <div class="col-sm-8">
            <input type="text" id="chauffeur_last_name" value="{{ $camion->Type }}"
            readonly name="Type" class="form-control" placeholder="Prénom">
            </div>
        </div>

        <!-- Opération -->
        <div class="form-group row mb-2">
            <label for="Operation" class="col-sm-4 col-form-label text-right">Opération :</label>
            <div class="col-sm-8">
            <input type="text" id="chauffeur_last_name" value="{{ $camion->Operation }}"
            readonly name="Operation" class="form-control" placeholder="Prénom">
            </div>
        </div>

        <!-- Heure d'enregistrement -->
        <div class="form-group row mb-2">
            <label for="heure_enregistrement" class="col-sm-4 col-form-label text-right">Heure d'enregistrement :</label>
            <div class="col-sm-8">
                <input type="text" id="heure_enregistrement"  
                name="heure_enregistrement" class="form-control " value="{{ $camion->heure_enregistrement }}" readonly 
                required autofocus >
                @error('heure_enregistrement')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

                <!-- NumeroBl -->
                <div class="form-group row mb-2">
            <label for="Numero_Bl" class="col-sm-4 col-form-label text-right">Numero de Bl :</label>
            <div class="col-sm-8">
                <input type="text" id="Immatricluation" 
                name="Numero_Bl" class="form-control @error('Immatriculation')
                 is-invalid @enderror" value="{{ $camion->Numero_Bl }}" readonly required placeholder=" Numero bl">
                @error('Immatriculation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        
        <!-- Heure de sortie -->
        <div class="form-group row mb-2">
            <label for="heure_sortie" class="col-sm-4 col-form-label text-right">Heure de sortie :</label>
            <div class="col-sm-8">
                <input type="text" id="heure_sortie"  
                name="heure_sortie" class="form-control " value="" readonly 
                required autofocus >
                @error('heure_sortie')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>



        <!-- Bouton d'inscription -->
        <div class="form-group row mb-2">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary" style="color: #fff; width: 250px; background: #84C7AE; border: 0px; cursor: pointer;">
                    Enregistrer
                </button>
            </div>
        </div>
</form>

<!--<script>
        function updateClock() {
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var seconds = now.getSeconds().toString().padStart(2, '0');
            var timeString = hours + ':' + minutes + ':' + seconds;
            document.getElementById('heure_sortie').value = timeString;
        }

        // Mettre à jour l'heure toutes les secondes
        setInterval(updateClock, 1000);

        // Initialiser l'heure lors du chargement de la page
        updateClock();
    </script>-->
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
            document.getElementById('heure_sortie').value = fullDateTimeString;

        } catch (error) {
            console.error("Oops, problème pour récupérer l'heure du Maroc ! ", error);
        }
    }

    // Mettre à jour chaque seconde
    setInterval(fetchMoroccoTime, 1000);

    // Initialiser l'heure au chargement
    fetchMoroccoTime();
</script>

</div>
@endsection
