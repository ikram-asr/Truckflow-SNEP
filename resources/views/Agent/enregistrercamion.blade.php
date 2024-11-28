@extends('layouts.canva')

@section('content')

<div class="container1" style="width: 100%; max-width: 800px; margin: auto; margin-top:100px;">
    <h3 style="font-weight: bold;">Enregistrer camion</h3>
    <form method="POST" action="{{ route('enregistrer') }}">
        @csrf
        <!-- Id Passage   -->
        <div class="form-group row mb-2">
            <label for="IdPassage" class="col-sm-4 col-form-label text-right" style="margin-bottom: 10px; ">ID de Passage :</label>
            <div class="col-sm-8">
            <input type="text" class="form-control readonly-input " id="IdPassage" readonly value="{{ $nextId }}"
            name="IdPassage"  
           >
        </div>
        <!-- Immatriculation -->
        <div class="form-group row mb-2">
            <label for="Immariculation" class="col-sm-4 col-form-label text-right" >Immatriculation :</label>
            <div class="col-sm-8">
                <input type="text" id="Immatricluation" 
                name="Immatriculation" class="form-control @error('Immatriculation')
                 is-invalid @enderror" value="{{ old('Immatriculation') }}" required placeholder=" Immatriculation">
                @error('Immatriculation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    
        <div class="form-group row mb-2">
            <label for="Cin_transporteur" class="col-sm-4 col-form-label text-right">Chauffeur :</label>
            <div class="col-sm-8">
                <input type="text" id="chauffeur_cin" name="Cin_transporteur" class="form-control" placeholder="CIN">
            </div>
        </div>

        <div class="form-group row mb-2">
            <div class="col-sm-6">
                <input type="text" id="chauffeur_first_name" required name="Nom_transporteur" class="form-control" placeholder="Nom">
            </div>
            <div class="col-sm-6">
                <input type="text" id="chauffeur_last_name" required name="Prenom_transporteur" class="form-control" placeholder="Prénom">
            </div>
        </div>

        <!-- Type véhicule -->
        <div class="form-group row mb-2">
            <label for="Type" class="col-sm-4 col-form-label text-right">Type de véhicule :</label>
            <div class="col-sm-8">
                <select id="Type" name="Type" class="form-control">
                @foreach($types_vehicule as $type)
                        <option value="{{ $type->Type }}">{{ $type->Type }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Opération -->
        <div class="form-group row mb-2">
            <label for="Operation" class="col-sm-4 col-form-label text-right">Opération :</label>
            <div class="col-sm-8">
                <select id="Operation" name="Operation" class="form-control">
                    <option>Chargement</option>
                    <option>Déchargement</option>
                </select>
            </div>
        </div>

        <!-- Heure d'enregistrement -->
        <div class="form-group row mb-2">
            <label for="heure_enregistrement" class="col-sm-4 col-form-label text-right">Heure d'enregistrement :</label>
            <div class="col-sm-8">
                <input type="text" id="heure_enregistrement"  
                name="heure_enregistrement" class="form-control readonly-input " value="" readonly 
                required autofocus >
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
            document.getElementById('heure_enregistrement').value = timeString;
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
            document.getElementById('heure_enregistrement').value = fullDateTimeString;

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
