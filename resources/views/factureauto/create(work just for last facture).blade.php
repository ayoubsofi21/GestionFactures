@extends('layouts.master')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<style>
    .card-facture {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .card-header-facture {
        border-bottom: 2px solid rgba(0, 0, 0, 0.1);
    }
    .facture-viewer-container {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        height: 500px;
        display: none;
        margin-top: 1rem;
    }
    .pdf-viewer {
        width: 100%;
        height: 100%;
        border: none;
    }
    .btn-visualiser {
        background-color: #343a40;
        color: white;
    }
    .btn-visualiser:hover {
        background-color: #23272b;
        color: white;
    }
    .btn-link-custom {
        color: #007bff;
        text-decoration: underline;
        padding: 0;
    }
    .btn-link-custom:hover {
        color: #0056b3;
        text-decoration: underline;
    }
    .form-label {
        font-weight: 600;
        color: #495057;
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="card card-facture">
        <div class="card-header card-header-facture bg-white">
            <h4 class="mb-0 text-danger">Demande autorisation enregistrement facture</h4>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('factureAuto.store') }}">
                @csrf

                <!-- Numéro facture -->
                <div class="form-group row align-items-center">
                    <label class="col-md-3 col-form-label form-label">Numéro facture :</label>
                    <div class="col-md-9">
                        <select class="form-control" id="facture_id" name="facture_id" onchange="fillFactureData(this.value)">
                            <option value="">-- Choisir --</option>
                            @foreach($autoenregistrements as $auto)
                                <option value="{{ $auto->id }}" 
                                        data-scan="{{ $auto->scan_facture }}"
                                        data-autorisation="{{ $auto->numero_autorisation ?? $auto->id }}"
                                        data-motif-rejet="{{ $auto->motif_rejet ?? '' }}"
                                        data-visible="{{ $auto->visible }}">
                                    {{ $auto->numero_facture }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Scan Facture -->
                <div class="form-group row align-items-center">
                    <label class="col-md-3 col-form-label form-label">Scan Facture :</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="scan_facture" name="scan_facture" readonly>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-visualiser btn-block" id="visualiser" onclick="showFacture()">
                            Visualiser Facture
                        </button>
                    </div>
                </div>

                <!-- Ouvrir Facture -->
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <button type="button" class="btn btn-link-custom" id="ouvrir_facture" style="display: none;">
                            Ouvrir Facture
                        </button>
                    </div>
                </div>

                <!-- Numéro autorisation -->
                <div class="form-group row align-items-center">
                    <label class="col-md-3 col-form-label form-label">Numéro autorisation :</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="numero_autorisation" name="numero_autorisation" readonly>
                    </div>
                </div>

                <!-- Motif Rejet -->
                <div class="form-group row align-items-center">
                    <label class="col-md-3 col-form-label form-label">Motif Rejet :</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="motif_rejet">
                    </div>
                </div>

                <!-- Facture Viewer -->
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <div class="facture-viewer-container" id="factureViewer">
                            <iframe class="pdf-viewer" id="pdfViewer" src=""></iframe>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success px-4 mr-2">Valider</button>
                        <button type="submit" class="btn btn-danger px-4"
                            onclick="event.preventDefault();
                                     document.querySelector('#reject-form input[name=facture_id]').value = document.getElementById('facture_id').value;
                                     document.querySelector('#reject-form input[name=motif_rejet]').value = document.querySelector('input[name=motif_rejet]').value;
                                     document.getElementById('reject-form').submit();">
                            Rejeter
                        </button>
                    </div>
                </div>
            </form>

            <!-- Hidden Reject Form -->
            <form id="reject-form" method="POST" action="{{ route('factureAuto.destroy', 0) }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="facture_id" value="">
                <input type="hidden" name="motif_rejet" value="">
            </form>
        </div>
    </div>
</div>

<script>
function fillFactureData(selectedId) {
    if (!selectedId) {
        // Clear fields if no selection
        document.getElementById('scan_facture').value = '';
        document.getElementById('numero_autorisation').value = '';
        document.getElementById('ouvrir_facture').style.display = 'none';
        return;
    }

    const selectedOption = document.querySelector(`#facture_id option[value="${selectedId}"]`);
    const scanPath = selectedOption.dataset.scan;
    
    document.getElementById('scan_facture').value = scanPath || '';
    document.getElementById('numero_autorisation').value = selectedOption.dataset.autorisation || '';
    
    // Show/hide "Ouvrir Facture" button
    const ouvrirBtn = document.getElementById('ouvrir_facture');
    if (scanPath) {
        ouvrirBtn.style.display = 'inline-block';
        ouvrirBtn.onclick = function() {
            window.open("{{ asset('storage/') }}/" + scanPath, '_blank');
        };
    } else {
        ouvrirBtn.style.display = 'none';
    }
}

function showFacture() {
    const scanPath = document.getElementById('scan_facture').value;
    if (!scanPath) {
        alert('Veuillez sélectionner une facture d'abord');
        return;
    }
    
    const viewer = document.getElementById('factureViewer');
    const pdfViewer = document.getElementById('pdfViewer');
    
    // Set the PDF source
    pdfViewer.src = "{{ asset('storage/') }}/" + scanPath + "#toolbar=0&navpanes=0";
    viewer.style.display = 'block';
    
    // Scroll to the viewer
    viewer.scrollIntoView({ behavior: 'smooth' });
}
</script>
@endsection