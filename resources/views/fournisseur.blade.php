@extends('layouts.master')

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">
</head>

@section('content')
<div class="container py-5">
  <div class="card shadow">
    <div class="card-header bg-white text-white text-center">
      <h4 class="mb-0 text-primary fw-bold">Gestion des Fournisseurs</h4>
    </div>

    <div class="card-body">
      <form action="{{ route('fournisseur.store') }}" method="POST" class="mb-4">
        @csrf

        <div class="form-row">
          <div class="form-group col-md-5">
            <label for="nom">Fournisseur :</label>
            <input type="text" name="nom" class="form-control" placeholder="Saisir le nom du fournisseur" value="{{ request('nom') }}" >
          </div>

          <div class="form-group col-md-4">
            <label for="ice">ICE :</label>
            <input type="text" name="ice" class="form-control" placeholder="Saisir l'ICE" value="{{ request('ice') }}" >
          </div>

          <div class="form-group col-md-3 d-flex align-items-end"">
            <button type="submit" name="action" value="ajouter" class="btn btn-success ">➕ Ajouter</button>
            <button type="submit" name="action" value="rechercher" class="btn btn-primary">🔍 Rechercher</button>
          </div>
        </div>

        <div class="text-right">
          <a href="{{ route('fournisseur.index') }}" class="btn btn-secondary">↺ Initialiser</a>
        </div>
      </form>

      @if($fournisseurs->count() > 0)
      <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
          <thead class="thead-light">
            <tr>
              <th>Fournisseur</th>
              <th>ICE</th>
            </tr>
          </thead>
          <tbody>
            @foreach($fournisseurs as $fournisseur)
            <tr>
              <td>{{ $fournisseur->nom }}</td>
              <td>{{ $fournisseur->ice }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @else
      <div class="alert alert-warning text-center">
        Aucun fournisseur trouvé.
      </div>
      @endif

      <div class="mt-4 text-center">
        <a href="{{ route('factures.index') }}" class="btn btn-outline-danger">← Retour</a>
      </div>
    </div>
  </div>
</div>
@endsection
