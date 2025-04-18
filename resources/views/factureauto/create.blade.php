@extends('layouts.master')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
@endpush

@section('content')
<div class="container mt-5">
    <h4 class="text-danger text-center">Demande autorisation enregistrement facture</h4>

    <form method="POST" action="{{ route('factureAuto.store') }}">
        @csrf

        <!-- Numéro facture -->
        <div class="mb-3">
            <label>Numéro facture:</label>
            <select class="form-control" id="facture_id" name="facture_id">
                <option value="">-- Choisir --</option>
                @foreach($autoenregistrements as $auto)
                    <option value="{{ $auto->id }}">{{ $auto->numero_facture }}</option>
                @endforeach
            </select>
        </div>

        <!-- Scan Facture -->
        <div class="mb-3">
            <label>Scan Facture:</label>
            <input type="text" class="form-control" id="scan_facture" name="scan_facture" readonly>
            <button type="button" class="btn btn-dark mt-2" id="visualiser">Visualiser Facture</button>
        </div>

        <!-- Numéro autorisation -->
        <div class="mb-3">
            <label>Numéro autorisation:</label>
            <input type="text" class="form-control" id="numero_autorisation" name="numero_autorisation" readonly>
            <a href="#" target="_blank" class="btn btn-link" id="ouvrir_facture">Ouvrir Facture</a>
        </div>

        <!-- Motif Rejet -->
        <div class="mb-3">
            <label>Motif Rejet:</label>
            <input type="text" class="form-control" name="motif_rejet">
        </div>

        <!-- Boutons -->
        <div class="mb-3 d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Valider</button>
            <button type="submit" class="btn btn-danger"
                onclick="event.preventDefault();
                         document.querySelector('#reject-form input[name=facture_id]').value = document.getElementById('facture_id').value;
                         document.querySelector('#reject-form input[name=motif_rejet]').value = document.querySelector('input[name=motif_rejet]').value;
                         document.getElementById('reject-form').submit();">
                Rejeter
            </button>
        </div>
    </form>

    <!-- Formulaire rejet -->
    <form id="reject-form" method="POST" action="{{ route('factureAuto.destroy', 0) }}">
        @csrf
        @method('DELETE')
        <input type="hidden" name="facture_id" value="">
        <input type="hidden" name="motif_rejet" value="">
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const factureSelect = document.getElementById('facture_id');
        const scanInput = document.getElementById('scan_facture');
        const numeroInput = document.getElementById('numero_autorisation');
        const visualiserBtn = document.getElementById('visualiser');
        const ouvrirBtn = document.getElementById('ouvrir_facture');

        factureSelect.addEventListener('change', function () {
            const factureId = this.value;

            if (!factureId) {
                scanInput.value = '';
                numeroInput.value = '';
                ouvrirBtn.href = '#';
                return;
            }

            fetch(`/factureauto/info/${factureId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.error) throw new Error(data.error);

                    scanInput.value = data.scan;
                    numeroInput.value = data.id;

                    ouvrirBtn.href = data.scan;
                    visualiserBtn.onclick = () => window.open(data.scan, '_blank');
                })
                .catch(() => {
                    alert("Erreur lors du chargement de la facture.");
                    scanInput.value = '';
                    numeroInput.value = '';
                    ouvrirBtn.href = '#';
                });
        });
    });
</script>
@endpush
