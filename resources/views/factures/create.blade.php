@extends('layouts.master')

@section('content')
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<div class="container mt-5">
    <h2 align="center" class="text-primary fw-bold">Enregistrement d'une Facture</h2>

    <form action="{{ route('factures.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="date_reception_facture" class="form-label">Date réception facture</label>
            <input type="date" name="date_reception_facture" id="date_reception_facture" class="form-control" value="{{ old('date_reception_facture', \Carbon\Carbon::now()->format('Y-m-d')) }}" readonly>

        </div>
        <div class="mb-3">
            <label for="date_facture" class="form-label">Date facture</label>
            <input type="date" name="date_facture" id="date_facture" class="form-control" value="{{ old('date_facture') }}" required>
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
                <input type="number" step="0.01" id="montant_ht" name="montant_ht" class="form-control" value="{{ old('montant_ht') }}">
            </div>
            <div class="col">
                <label for="taux_tva" class="form-label">TVA (%)</label>
                <select id="taux_tva" name="taux_tva" class="form-control">
                    <option value="20" {{ old('taux_tva', 20) == 20 ? 'selected' : '' }}>20%</option>
                    <option value="14" {{ old('taux_tva') == 14 ? 'selected' : '' }}>14%</option>
                    <option value="10" {{ old('taux_tva') == 10 ? 'selected' : '' }}>10%</option>
                    <option value="8" {{ old('taux_tva') == 8 ? 'selected' : '' }}>8%</option>
                </select>
            </div>
            <div class="col">
                <label for="montant_ttc" class="form-label">Montant TTC</label>
                <input type="number" step="0.01" id="montant_ttc" name="montant_ttc" class="form-control" value="{{ old('montant_ttc') }}">
            </div>
        </div>

    
        <div class="mb-3">
            <label class="form-label">Type Facture</label><br>
            @foreach(['M' => 'Marché', 'C' => 'Consultation', 'Ct' => 'Contrat', 'D' => 'Devis'] as $key => $label)
                <label class="me-3">
                    <input type="radio" name="type_facture" value="{{ $key }}"
                    {{ old('type_facture', 'D') == $key ? 'checked' : '' }}> {{ $label }}
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
            <label for="entite" class="form-label">Entité</label>
            <select name="entite" class="form-control">
                <option value="">Sélectionner une entité</option>
                <option value="DE" {{ old('entite') == 'DE' ? 'selected' : '' }}>DE</option>
                <option value="DOM" {{ old('entite') == 'DOM' ? 'selected' : '' }}>DOM</option>
                <option value="GNV" {{ old('entite') == 'GNV' ? 'selected' : '' }}>GNV</option>
                <option value="MM" {{ old('entite') == 'MM' ? 'selected' : '' }}>MM</option>
                
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
    <script>
        //Condition de calcul du montant TTC
        document.addEventListener('DOMContentLoaded', function () {
            const htInput = document.getElementById('montant_ht');
            const tvaInput = document.getElementById('taux_tva');
            const ttcInput = document.getElementById('montant_ttc');
    
            function calculateTTC() {
                const ht = parseFloat(htInput.value) || 0;
                const tva = parseFloat(tvaInput.value) || 0;
                const ttc = ht + (ht * tva / 100);
                ttcInput.value = ttc.toFixed(2);
            }
    
            htInput.addEventListener('input', calculateTTC);
            tvaInput.addEventListener('input', calculateTTC);
        });

    //Condition de calcul de la date de la facture
    document.addEventListener('DOMContentLoaded', function () {
        const dateReceptionInput = document.getElementById('date_reception_facture');
        const dateFactureInput = document.getElementById('date_facture');
        const form = document.querySelector('form');
        
        form.addEventListener('submit', function(event) {
            // event.preventDefault();
            const dateReception = new Date(dateReceptionInput.value);
            const dateFacture = new Date(dateFactureInput.value);
            const diffTime = Math.abs(dateFacture-dateReception);
            const diffDays = diffTime / (1000 * 3600 * 24);
            if (diffDays > 5 ) {
                alert('La date de la facture doit être dans les 5 jours suivant la date de réception.');
                event.preventDefault(); // Prevent form submission
            }
        });
    });
    </script>
</div>
@endsection
