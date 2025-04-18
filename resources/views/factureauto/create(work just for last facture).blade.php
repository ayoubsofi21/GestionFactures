@extends('layouts.master')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous">
@endpush

@section('content')
<div class="container mt-5">
    <h4 class="text-danger text-center">Demande autorisation enregistrement facture</h4>

    <form method="POST" action="{{ route('factureAuto.store') }}">
        @csrf

        <!-- Facture Selection -->
        <div class="mb-3">
            <label>Numéro facture:</label>
            <select class="form-control" id="facture_id" name="facture_id">
                <option value="">-- Choisir --</option>
                @foreach($autoenregistrements as $autoenregistrement)
                    <option value="{{ $autoenregistrement->id }}">
                        {{ $autoenregistrement->numero_facture }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Scan Facture -->
        <div class="mb-3">
            <label>Scan Facture:</label>
            <input type="text" class="form-control" id="scan_facture" name="scan_facture" value="{{$autoenregistrement->scan_facture}}" readonly>
            <button type="button" class="btn btn-dark mt-2" id="visualiser"
                onclick="window.open(document.getElementById('scan_facture').value, '_blank')">
                Visualiser Facture
            </button>
        </div>

        <!-- Numéro autorisation -->
        <div class="mb-3">
            <label>Numéro autorisation:</label>
            <input type="text" class="form-control" id="numero_autorisation"  name="numero_autorisation"  value="{{$autoenregistrement->id}}" readonly>
            <a href="{{ asset('storage/' . $autoenregistrement->scan_facture) }}" class="btn btn-link">
                Ouvrir Facture
            </a>
        </div>

        <!-- Motif Rejet -->
        <div class="mb-3">
            <label>Motif Rejet:</label>
            <input type="text" class="form-control" name="motif_rejet">
        </div>

        <!-- Buttons -->
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

    <!-- Rejection Form -->
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
        const numeroAutorisation = document.getElementById('numero_autorisation');

        factureSelect.addEventListener('change', function () {
            const factureId = this.value;

            if (!factureId) {
                scanInput.value = '';
                numeroAutorisation.value = '';
                return;
            }

            fetch(`/factureauto/info/${factureId}`)
                .then(response => {
                    if (!response.ok) throw new Error("Facture not found");
                    return response.json();
                })
                .then(data => {
                    // Show path in input
                    scanInput.value = data.scan;

                    // Fill in the autorisation number too
                    numeroAutorisation.value = data.id;
                })
                .catch(error => {
                    scanInput.value = '';
                    numeroAutorisation.value = '';
                    alert('Erreur lors du chargement de la facture.');
                });
        });
    });
</script>

@endpush
