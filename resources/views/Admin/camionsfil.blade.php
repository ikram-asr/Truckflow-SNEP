<!-- Admin/camionsfil.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Résultats de la recherche</h1>

    @if($camionsfil->isEmpty())
        <p>Aucun camion trouvé pour cette date.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Immatriculation</th>
                    <th>Type</th>
                    <th>Opération</th>
                    <th>Date d'enregistrement</th>
                    <!-- Ajoutez d'autres colonnes ici -->
                </tr>
            </thead>
            <tbody>
                @foreach($camionsfil as $camion)
                    <tr>
                        <td>{{ $camion->Immatriculation }}</td>
                        <td>{{ $camion->Type }}</td>
                        <td>{{ $camion->Operation }}</td>
                        <td>{{ $camion->created_at }}</td>
                        <!-- Ajoutez d'autres colonnes ici -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
