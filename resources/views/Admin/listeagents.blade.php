@extends('layouts.dashboard')
@section('content')
<div class="container1 " style="       
    padding: 20px; 
    margin: 10px;      background: #F6FBF9;
            border-radius: 10px;
            box-shadow: 0px 4px 10px 1px rgba(0,0,0,0.1);">

<h4 class="text-center"> Liste des Agents</h4>
<div class="table-responsive " >
  <table  id="ag" class="table table-hover table-striped table align-middle table-responsive-sm table-responsive-md
  table-responsive-lg">
  
  <thead>
    <tr>
    <th scope="col" class="text-center">BUTTONS</th>
      <th scope="col" class="text-center">Id Agent</th>
      <th scope="col" class="text-center">Nom Agent</th>
      <th scope="col" class="text-center">Prénom Agent</th>
      <th scope="col" class="text-center">Nom d'utilisateur</th>
      <th scope="col" class="text-center">Mot de passe</th>
      <th scope="col" class="text-center">Créé par</th>
      <th scope="col" class="text-center">Créé le</th>
    </tr>
  </thead>
  <tbody>
  @foreach($agents as $agent)
    <tr> 
      <th scope="row" class="align-items">
      <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group mr-2" role="group" aria-label="First group">
  <form action="{{ route('supprimeragent', $agent->Agent_id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet agent ?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger" style="color: #fff; width: 50px; border: 0px; cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                </svg> </button> </form>
                
 

<a role="button" href="{{ route('modif', $agent->Agent_id) }}" 
type="submit" class="btn btn-primary " style="color: #fff; width: 50px; background: #84C7AE; border: 0px; cursor: pointer;">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg>   </a>
  </div>
      </th>
                    <td class="text-center">{{ $agent->Agent_id }}</td>
                    <td class="text-center">{{ $agent->Nom }}</td>
                    <td class="text-center">{{ $agent->Prenom }}</td>
                    <td class="text-center">{{ $agent->nomutilisateur }}</td>
					
<td id="password-{{ $agent->id }}" class="password-cell text-center">••••••••••</td>
					<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordElements = document.querySelectorAll('.password-cell');
        passwordElements.forEach(el => {
            el.innerText = '••••••••••'; // Remplacez ce texte par des points ou une autre chaîne de votre choix
        });
    });
</script>
                    <td class="text-center">{{ $agent->admin ? $agent->admin->Nom . ' ' . $agent->admin->Prénom : 'N/A' }}</td>
                    <td class="text-center">{{ $agent->created_at }}</td>
                    @endforeach
    </tr>
  </tbody>
</table>  

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
<script>
  	
 $(document).ready(function() {
            // Initialize DataTables for both tables
            $('#ag').DataTable({
                // Custom options for Table 1 (optional)
            });
            $('#adminnn').DataTable({
                // Custom options for Table 2 (optional)
            });
        });
</script>
</div>

</div>

<div class="container1 " style="       
    padding: 20px; 
    margin: 10px;      background: #F6FBF9;
            border-radius: 10px;
            box-shadow: 0px 4px 10px 1px rgba(0,0,0,0.1);">
<h4 class="text-center"> Liste des Admins</h4>

<div class="table-responsive " >
  <table  id="adminnn" class="table table-hover table-striped table align-middle table-responsive-sm table-responsive-md
  table-responsive-lg">
  <thead>
    <tr>
    <th scope="col" class="text-center">BUTTONS</th>
      <th scope="col" class="text-center">Id Agent</th>
      <th scope="col" class="text-center">Nom Agent</th>
      <th scope="col" class="text-center">Prénom Agent</th>
      <th scope="col" class="text-center">Nom d'utilisateur</th>
      <th scope="col" class="text-center">Mot de passe</th>
      <th scope="col" class="text-center">Créé le</th>
    </tr>
  </thead>
  <tbody>
  @foreach($admins as $admin)
    <tr> 
      <th scope="row" class="align-items">
      <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group mr-2" role="group" aria-label="First group">
  <form action="{{ route('supprimeradmin', $admin->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet admin ?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger" style="color: #fff; width: 50px; border: 0px; cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                </svg> </button> </form>
                
 

<a role="button" href="{{ route('mod', $admin->id) }}" 
type="submit" class="btn btn-primary " style="color: #fff; width: 50px; background: #84C7AE; border: 0px; cursor: pointer;">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg>   </a>
  </div>
      </th>
                    <td class="text-center">{{ $admin->id }}</td>
                    <td class="text-center">{{ $admin->Nom }}</td>
                    <td class="text-center">{{ $admin->Prénom }}</td>
                    <td class="text-center">{{ $admin->nom_utilisateur }}</td>
					
<td " class="password-cell text-center">••••••••••</td>
		
                    <td class="text-center">{{ $admin->created_at }}</td>
                    @endforeach
    </tr>
  </tbody>

</table>  
</div>

</div>
@endsection