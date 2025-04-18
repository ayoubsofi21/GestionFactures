@extends('layouts.master')

@section('content')
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="text-danger fw-bold">📋 Liste des marchés</h2>
    </div>
    <form method="POST" action="{{ route('marche.store') }}" class="mb-4">
        @csrf
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="numero" class="form-label fw-semibold">N° marché</label>
                <input type="text" class="form-control shadow-sm" id="numero" name="marche_number" required>
            </div>
            <div class="col-md-3">
                <label for="objet" class="form-label fw-semibold">Objet</label>
                <input type="text" class="form-control shadow-sm" id="objet" name="object" required>
            </div>
            <div class="col-md-3">
                <label for="titulaire" class="form-label fw-semibold">Titulaire</label>
                <input type="text" class="form-control shadow-sm" id="titulaire" name="tutilier" required>
            </div>
            <div class="col-md-3">
                <label for="delai_paiement" class="form-label fw-semibold">Délai paiement</label>
                <select class="form-select shadow-sm" id="delai_paiement" name="payment_delay">
                    <option value="30">30</option>
                    <option value="60" selected>60</option>
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success px-4 shadow">💾 Valider</button>
            <a href="{{ route('marche.create') }}" class="btn btn-outline-secondary px-4 shadow">🔄 Initialiser</a>
        </div>
    </form>
    <div class="table-responsive shadow-sm">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">Marché</th>
                    <th scope="col">Objet</th>
                    <th scope="col">Delay</th>
                </tr>
            </thead>
            <tbody>
                @foreach($marches as $marche)
                    <tr>
                        <td>{{ $marche->marche_number }}</td>
                        <td>{{ $marche->object }}</td>
                        <td>{{ $marche->payment_delay }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection