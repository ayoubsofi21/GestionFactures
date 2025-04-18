@extends('layouts.master')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .focus-yellow:focus {
            border-color: #ffc107 !important; /* Bootstrap's warning/yellow */
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.5);
            background-color: #fffbea; /* subtle yellow background */
        }
    </style>
</head>
<body>
    <form action="{{ route('autorisation.store') }}" method="POST" enctype="multipart/form-data" class="container mt-5">
        @csrf
        <div class="card shadow p-4">
            <div class="card-header bg-primary text-white mb-3">
                <h2>Demande de autorisation de facture</h2>
            </div>
    
            <div class="mb-3">
                <label for="numero_facture" class="form-label">Numéro Facture :</label>
                <input type="text" class="form-control focus-yellow" id="numero_facture" placeholder="Saisir votre numéro facture" name="numero_facture" required>
            </div>
    
            <div class="mb-3">
                <label for="scan_facture" class="form-label">Scan Facture :</label>
                <input type="text" class="form-control mb-2" disabled placeholder="Aucun fichier sélectionné" id="file-name-display">
                
                <input type="file" id="scan_facture" name="scan_facture" class="d-none"
                       onchange="document.getElementById('file-name-display').value = this.files[0]?.name || 'Aucun fichier sélectionné';" required>
                
                <label for="scan_facture" class="btn btn-outline-primary btn-sm mb-0">Ajouter</label>
            </div>
    
            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-primary">Valider</button>
                <a href="{{ route('factures.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </form>
    

</body>
</html>
@endsection