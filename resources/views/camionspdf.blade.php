<!DOCTYPE html>
<html>
<head>
    <title>Tableau des Camions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .title-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .title-container img {
            width: 180px; /* Adjust the width as needed */
            height: auto;
            position: fixed;
            top:20px;
            right: 20px;
        }
            
    </style>
</head>
<body>
<div class="title-container">

    <h1>Liste des Camions</h1>
    <img src="images/logo.png" alt="Logo" /> </div>
    <div class="container  mt-5  rounded shadow-sm" style="background: #F6FBF9;
            border-radius: 50px;
            box-shadow: 0px 4px 10px 1px rgba(0,0,0,0.1);">
<!-- On tables -->
<div class="table-responsive " >
  <table id="cam" class="table table-hover text-center table-sm table-striped ">
  <thead>

    <tr>
      <th class="text-center" scope="col">Id Passage</th>
      <th class="text-center" scope="col">Numéro BL</th>
      <th class="text-center" scope="col">Heure enregistrement</th>
      <th class="text-center" scope="col">Heure d'affectation de BL</th>
      <th class="text-center" scope="col">Heure sortie</th>
      <th class="text-center" scope="col">Période de séjour</th>
      <th class="text-center" scope="col">Opération</th>
      <th class="text-center" scope="col">Véhicule</th>
      <th class="text-center" scope="col">Immatriculation</th>
      <th class="text-center" scope="col">CIN chauffeur</th>
      <th class="text-center" scope="col">Nom chauffeur</th>
      <th class="text-center" scope="col">Prénom chauffeur</th>
      <th class="text-center" scope="col">Date de création</th> 
    </tr>
  </thead>
  <tbody >
  @foreach($camions as $camion)
    <tr> 

      <td class="text-center">{{ $camion->IdPassage }}</td>
      <td class="text-center">{{ $camion->Numero_Bl ? $camion->Numero_Bl : '----' }}</td>
      <td class="text-center">{{ $camion->heure_enregistrement }}</td>
      <td class="text-center">{{ $camion->heure_affectation_bl ? $camion->heure_affectation_bl : '----'}}</td>
      <td class="text-center">{{ $camion->heure_sortie ? $camion->heure_sortie : '----' }}</td>
      <td class="text-center">{{ $camion->Sejour }}</td>
      <td class="text-center">{{ $camion->Operation }}</td>
      <td class="text-center">{{ $camion->Type }}</td>
      <td class="text-center">{{ $camion->Immatriculation }}</td>
      <td class="text-center">{{ $camion->Cin_transporteur }}</td>
      <td class="text-center">{{ $camion->Nom_transporteur }}</td>
      <td class="text-center">{{ $camion->Prenom_transporteur }}</td>
      <td class="text-center">{{ $camion->created_at ? $camion->created_at : '----' }}</td> <!-- Ajoutez la donnée pour les admins -->
      <!--<td>{{ $camion->creepar }}</td>-->
                    @endforeach
    </tr>
  </tbody>
</table>  

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
<script>
  	
let table = new DataTable('#cam');
</script>
</div>
<div></div>
 

 </div>

</body>
</html>
