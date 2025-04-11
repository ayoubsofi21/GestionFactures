@extends('layouts.master')

@section('content')
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"></head>
<div class="container mt-5">
    <h2 align="center">Enregistrement d'une Facture</h2>

    <form action="{{ route('factures.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="date_reception_facture" class="form-label">Date réception facture</label>
            <input type="date" name="date_reception_facture" class="form-control" value="{{ old('date_reception_facture', \Carbon\Carbon::now()->format('Y-m-d')) }}">

        </div>
        <div class="mb-3">
            <label for="date_facture" class="form-label">Date facture</label>
            <input type="date" name="date_facture" class="form-control" value="{{ old('date_facture') }}">
        </div>
        <div class="mb-3">
            <label for="numero_facture" class="form-label">Numéro facture</label>
            <input type="text" name="numero_facture" class="form-control" value="{{ old('numero_facture') }}">
        </div>
        <div class="mb-3">
            <label for="numero_autorisation_dfccb" class="form-label">N° autorisation DFCCB</label>
            <input type="text" name="numero_autorisation_dfccb" class="form-control" value="{{ old('numero_autorisation_dfccb') }}">
        </div>
        <div class="mb-3">
            <label for="scan_facture" class="form-label">Scan Facture</label>
            <input type="file" name="scan_facture" class="form-control">
        </div>

        <div class="mb-3">
            <label for="fournisseur_id" class="form-label">Fournisseur</label>
            <select name="fournisseur_id" class="form-control">
                <option value="">Choisir un fournisseur</option>
                @foreach($fournisseurs as $fournisseur)
                    <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 row">
            <div class="col">
                <label for="montant_ht" class="form-label">Montant HT</label>
                <input type="number" step="0.01" name="montant_ht" class="form-control" value="{{ old('montant_ht') }}">
            </div>
            <div class="col">
                <label for="taux_tva" class="form-label">TVA (%)</label>
                <input type="number" step="0.01" name="taux_tva" class="form-control" value="{{ old('taux_tva', 20) }}">
            </div>
            <div class="col">
                <label for="montant_ttc" class="form-label">Montant TTC</label>
                <input type="number" step="0.01" name="montant_ttc" class="form-control" value="{{ old('montant_ttc') }}">
            </div>
        </div>

    
        <div class="mb-3">
            <label class="form-label">Type Facture</label><br>
            @foreach(['M' => 'Marché', 'C' => 'Consultation', 'Ct' => 'Contrat', 'D' => 'Divers'] as $key => $label)
                <label class="me-3">
                    <input type="radio" name="type_facture" value="{{ $key }}" {{ old('type_facture') == $key ? 'checked' : '' }}> {{ $label }}
                </label>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="numero_bl_attachement" class="form-label">N° BL/Attachement</label>
            <input type="text" name="numero_bl_attachement" class="form-control" value="{{ old('numero_bl_attachement') }}">
        </div>

        <div class="mb-3">
            <label for="numero_marche_bc_devis" class="form-label">N° Marché/BC/Devis</label>
            <input type="text" name="numero_marche_bc_devis" class="form-control" value="{{ old('numero_marche_bc_devis') }}">
        </div>

       
        <div class="mb-3">
            <label for="objet_facture" class="form-label">Objet</label>
            <input type="text" name="objet_facture" class="form-control" value="{{ old('objet_facture') }}">
        </div>

        
        <div class="mb-3">
            <label for="entite" class="form-label">Entité</label>
            <select name="entite" class="form-control">
                <option value="">Sélectionner une entité</option>
                <option value="DE" {{ old('entite') == 'DE' ? 'selected' : '' }}>DE</option>
                <!-- Ajoute d'autres entités si nécessaire -->
            </select>
        </div>
        <div class="mb-3">
            <label for="remarque" class="form-label">Remarque(s)</label>
            <textarea name="remarque" class="form-control">{{ old('remarque') }}</textarea>
        </div>

        {{-- Boutons --}}
        <button type="submit" class="btn btn-primary mb-5">Valider</button>
        <button type="reset" class="btn btn-secondary mb-5">Réinitialiser</button>
    </form>
</div>
@endsection
