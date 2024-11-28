<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="text-center">Fiche d'enregistrement</title>
    <style>

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
        .title-container h1 {
            margin-left: 20px; 
        }
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        table, th, td { border: 1px solid black; padding: 10px; }
    </style>
</head>
<body>
<div class="title-container">

    <h1>Fiche d'enregistrement</h1>
    <img src="images/logo.png" alt="Logo" /> </div>
    <table>
        <tr>
            <th>ID Passage</th>
            <td>{{ $IdPassage }}</td>
        </tr>
        <tr>
            <th>Immatriculation</th>
            <td>{{ $Immatriculation }}</td>
        </tr>
        <tr>
            <th>CIN Transporteur</th>
            <td>{{ $Cin_transporteur }}</td>
        </tr>
        <tr>
            <th>Nom Transporteur</th>
            <td>{{ $Nom_transporteur }}</td>
        </tr>
        <tr>
            <th>Prénom Transporteur</th>
            <td>{{ $Prenom_transporteur }}</td>
        </tr>
        <tr>
            <th>Type de Véhicule</th>
            <td>{{ $Type }}</td>
        </tr>
        <tr>
            <th>Opération</th>
            <td>{{ $Operation }}</td>
        </tr>
        <tr>
            <th>Heure d'enregistrement</th>
            <td>{{ $heure_enregistrement }}</td>
        </tr>
    </table>
</body>
</html>
