@extends('layouts.master')

@section('content')
  <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
<div class="container py-4">
    <h2 class="text-center text-danger mb-4">Gestion fournisseur(s)</h2>

    <form action="#" method="GET" class="mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-6">
                <label for="name" class="form-label">Fournisseur :</label>
                <input type="text" name="name" class="form-control" placeholder="Saisir le nom du Fournisseur" value="{{ request('name') }}">
            </div>
            <div class="col-md-4">
                <label for="ice" class="form-label">ICE :</label>
                <input type="text" name="ice" class="form-control" placeholder="ICE" value="{{ request('ice') }}">
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-dark">Chercher</button>
            </div>
        </div>
        <div class="mt-2 d-flex justify-content-end">
            <a href="#" class="btn btn-secondary">Initialiser</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-primary">
                <tr>
                    <th>Fournisseur</th>
                    <th>ICE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fournisseurs as $supplier)
                <tr>
                    <td>{{ $supplier->nom }}</td>
                    <td>{{ $supplier->ice }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3 text-center">
        <a href="#" class="btn btn-danger">&lt;&lt;&lt;</a>
    </div>
</div>
@endsection