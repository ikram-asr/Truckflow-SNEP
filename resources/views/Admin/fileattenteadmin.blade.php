@extends('layouts.dashboard')
@section('nav-item')

   <form action="{{ route('pdf1') }}" method="GET">
    <input type="hidden" name="search_date_start" value="{{ request('search_date_start') }}">
    <input type="hidden" name="search_date_end" value="{{ request('search_date_end') }}">
    <button type="submit" class="btn btn-light btn-custom" 
    style="height: 50px; width: 55px; ">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
  <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/>
  <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
</svg>
    </button>
</form>
   @endsection
@section('content')

<div class="table-responsive "  style="       
    padding: 20px; 
    margin: 10px;      background: #F6FBF9;
            border-radius: 10px;
            box-shadow: 0px 4px 10px 1px rgba(0,0,0,0.1);" >
                                   <form action="{{ route('filtredatefa') }}" method="GET" class="mb-3">
    @csrf
    <div class="row  d-flex justify-content-right align-items-center ">
        <div class="col-md-3">
            <input type="date" name="search_date_start" class="form-control" placeholder="Start Date" required>
        </div>
        <div class="col-md-3">
            <input type="date" name="search_date_end" class="form-control" placeholder="End Date" required>
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary" style="color: #fff; background: #84C7AE; border: 0px; cursor: pointer;">Filter</button>
        </div>
        <div class="col-md-1">
            <a href="{{ route('fattente') }}" class="btn btn-secondary" style="color: #fff; background: #f44336; border: 0px; cursor: pointer;">Effacer</a>
        </div>
    </div>
</form>
  <table  class="table table-hover table-striped table align-middle table-responsive-sm table-responsive-md
  table-responsive-lg">
  <table id="file" class="table table-hover table-striped table align-middle table-responsive-sm table-responsive-md
  table-responsive-lg">
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
      <th class="text-center"scope="col">Créé par</th> 

      <th class="text-center" scope="col">Date de création</th> 

      <!--<th scope="col">Créé par</th>-->
    </tr>
  </thead>
  <tbody>
  @foreach($camions as $camion)
  @if ($camion->Numero_Bl==NULL)
      
    <tr> 
    <td class="text-center">{{ $camion->IdPassage }}</td>
      <td class="text-center">{{ $camion->Numero_Bl ? $camion->Numero_Bl : '----' }}</td>
      <td class="text-center">{{ $camion->heure_enregistrement }}</td>
      <td class="text-center">{{ $camion->heure_affectation_bl ? $camion->heure_affectation_bl : '----'}}</td>

      <td class="text-center">{{ $camion->heure_sortie ? $camion->heure_sortie : '----' }}</td>
      <td class="text-center">{{ $camion->Sejour ? $camion->Sejour : '----' }}</td>
      <td class="text-center">{{ $camion->Operation }}</td>
      <td class="text-center">{{ $camion->Type }}</td>
      <td class="text-center">{{ $camion->Immatriculation }}</td>
      <td class="text-center">{{ $camion->Cin_transporteur }}</td>
      <td class="text-center">{{ $camion->Nom_transporteur }}</td>
      <td class="text-center">{{ $camion->Prenom_transporteur }}</td>
      <td class="text-center">@if ($camion->admin)
        {{ $camion->admin->Nom }}
        {{ $camion->admin->Prénom }} <!-- Affiche le nom de l'administrateur -->
    @elseif ($camion->agent)
        {{ $camion->agent->Nom }}
        {{ $camion->agent->Prenom }} <!-- Affiche le nom de l'agent -->
    @else
        ----
    @endif</td>
      <td class="text-center">{{ $camion->created_at ? $camion->created_at : '----' }}</td>

                    @endif

                    @endforeach
    </tr>
  </tbody>
</table>  
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
<script>
let table = new DataTable('#file');
</script>
</div>

</div>
@endsection