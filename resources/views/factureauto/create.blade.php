@extends('layouts.master')

@section('title', 'Gestion des Instances')
@section('show-profile')
@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header section -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-marsa-blue">Demande d'Autorisation</h1>
            <p class="text-gray-600">Validation et rejet des factures</p>
        </div>
        <div class="w-12 h-12 bg-marsa-light-blue bg-opacity-20 rounded-full flex items-center justify-center">
            <i class="fas fa-file-signature text-marsa-accent text-xl"></i>
        </div>
    </div>

    <!-- Main card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <!-- Card header with gradient -->
        <div class="bg-gradient-to-r from-marsa-blue to-marsa-light-blue px-6 py-4">
            <h2 class="text-white font-semibold text-lg">Instance de Validation</h2>
        </div>

        <!-- Form section -->
        <div class="p-6">
            <form method="POST" action="{{ route('factureAuto.store') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Numéro facture -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Numéro facture</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-file-invoice text-gray-400"></i>
                            </div>
                            <select class="pl-10 w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2" 
                                    name="facture_id" id="facture_id" onchange="fillFactureData(this.value)">
                                <option value="">-- Sélectionner une facture --</option>
                                @foreach($autoenregistrements as $auto)
                                    <option value="{{ $auto->id }}"
                                        data-scan="{{ $auto->scan_facture }}"
                                        data-autorisation="{{ $auto->numero_autorisation ?? $auto->id }}"
                                        data-motif-rejet="{{ $auto->motif_rejet ?? '' }}"
                                        data-date_creation="{{ $auto->date_creation ?? '' }}">
                                        {{ $auto->numero_facture }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Scan Facture -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Scan Facture</label>
                        <div class="flex gap-2">
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-file-pdf text-gray-400"></i>
                                </div>
                                <input type="text" class="pl-10 w-full rounded-lg border-gray-300 py-2 bg-gray-50" 
                                       id="scan_facture" name="scan_facture" readonly>
                            </div>
                            <button type="button" class="px-4 py-2 bg-marsa-blue hover:bg-marsa-dark-blue text-white rounded-lg transition-all"
                                    onclick="showFacture()">
                                <i class="fas fa-eye mr-1"></i> Voir
                            </button>
                        </div>
                    </div>

                    <!-- Numéro autorisation -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Numéro autorisation</label>
                        <input type="text" name="numero_autorisation" id="numero_autorisation" 
                               class="w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2">
                        <input type="hidden" id="date_creation" name="date_creation">
                    </div>

                    <!-- Date saisie -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de saisie</label>
                        <input type="text" class="w-full rounded-lg border-gray-300 bg-gray-50 py-2" 
                               name="date_saisie" value="{{ date('Y-m-d') }}" readonly>
                    </div>
                </div>

                <!-- Motif Rejet -->
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Motif de rejet</label>
                    <textarea name="motif_rejet" id="motif_rejet" 
                              class="w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2" 
                              rows="4" placeholder="Saisissez le motif de rejet (laisser vide pour validation)..."></textarea>
                </div>

                <!-- PDF Viewer -->
                <div class="mt-6 hidden" id="factureViewer">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-sm font-medium text-gray-700">Aperçu du document</h3>
                        <a href="#" id="ouvrir_facture" target="_blank" class="text-sm text-marsa-accent hover:text-marsa-blue">
                            <i class="fas fa-external-link-alt mr-1"></i> Ouvrir dans un nouvel onglet
                        </a>
                    </div>
                    <div class="border rounded-lg bg-gray-50" style="height: 500px;">
                        <iframe id="pdfViewer" class="w-full h-full" style="border: none;"></iframe>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex flex-col md:flex-row justify-end gap-3">
                    <button type="submit" class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-all flex items-center justify-center">
                        <i class="fas fa-check-circle mr-2"></i> Valider
                    </button>
                    <button type="button" onclick="rejectFacture()" class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-all flex items-center justify-center">
                        <i class="fas fa-times-circle mr-2"></i> Rejeter
                    </button>
                </div>
            </form>

            <!-- Hidden form for rejection -->
            <form id="reject-form" method="POST" action="{{ route('factureAuto.destroy', 0) }}" class="hidden">
                @csrf
                @method('DELETE')
                <input type="hidden" name="facture_id">
                <input type="hidden" name="motif_rejet">
            </form>
        </div>
    </div>
</div>

<script>
function fillFactureData(id) {
    const option = document.querySelector(`#facture_id option[value="${id}"]`);
    if (!option) return;

    document.getElementById('scan_facture').value = option.dataset.scan || '';
    document.getElementById('numero_autorisation').value = option.dataset.autorisation || '';
    document.getElementById('date_creation').value = option.dataset.date_creation || '';
    document.getElementById('motif_rejet').value = option.dataset.motifRejet || '';

    const scan = option.dataset.scan;
    const openBtn = document.getElementById('ouvrir_facture');
    if (scan) {
        openBtn.href = "{{ asset('storage/') }}/" + scan;
    } else {
        openBtn.href = '#';
    }
}

function showFacture() {
    const scan = document.getElementById('scan_facture').value;
    if (!scan) {
        alert('Veuillez d\'abord sélectionner une facture');
        return;
    }

    const viewer = document.getElementById('factureViewer');
    const iframe = document.getElementById('pdfViewer');

    iframe.src = "{{ asset('storage/') }}/" + scan + "#toolbar=0&navpanes=0";
    viewer.classList.remove('hidden');
    viewer.scrollIntoView({ behavior: 'smooth' });
}

function rejectFacture() {
    if (!document.getElementById('facture_id').value) {
        alert('Veuillez sélectionner une facture');
        return;
    }

    if (!confirm('Êtes-vous sûr de vouloir rejeter cette facture?')) {
        return;
    }

    document.querySelector('#reject-form input[name=facture_id]').value = document.getElementById('facture_id').value;
    document.querySelector('#reject-form input[name=motif_rejet]').value = document.getElementById('motif_rejet').value;
    document.getElementById('reject-form').submit();
}
</script>
@endsection