@extends('layouts.master')
@section('show-profile')
@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Form Header -->
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-marsa-blue">
            <i class="fas fa-file-invoice mr-2 text-marsa-gold"></i>
            Enregistrement d'une Facture
        </h2>
        <div class="w-20 h-1 bg-gradient-to-r from-marsa-gold to-amber-400 mx-auto mt-3 rounded-full"></div>
    </div>

    <!-- Form Container -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
        <form id="factureForm" action="{{ route('factures.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <!-- Dates Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="date_reception_facture" class="block text-sm font-medium text-gray-700 mb-1">Date de réception</label>
                    <input type="date" name="date_reception_facture" id="date_reception_facture" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-marsa-blue focus:border-marsa-blue"
                        value="{{ old('date_reception_facture', \Carbon\Carbon::now()->format('Y-m-d')) }}" readonly>
                </div>
                <div>
                    <label for="date_facture" class="block text-sm font-medium text-gray-700 mb-1">Date facture</label>
                    <input type="date" name="date_facture" id="date_facture" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-marsa-blue focus:border-marsa-blue"
                        value="{{ old('date_facture') }}" required>
                </div>
            </div>

            <!-- Invoice Info Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="numero_facture" class="block text-sm font-medium text-gray-700 mb-1">Numéro facture</label>
                    <input type="text" name="numero_facture" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-marsa-blue focus:border-marsa-blue"
                        value="{{ old('numero_facture') }}">
                </div>
                <div>
                    <label for="numero_autorisation_dfccb" class="block text-sm font-medium text-gray-700 mb-1">N° autorisation DFCCB</label>
                    <input type="text" name="numero_autorisation_dfccb" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-marsa-blue focus:border-marsa-blue"
                        value="{{ old('numero_autorisation_dfccb') }}">
                </div>
            </div>

            <!-- File Upload -->
            <div class="mb-6">
                <label for="scan_facture" class="block text-sm font-medium text-gray-700 mb-1">Scan Facture (PDF/Image)</label>
                <div class="mt-1 flex items-center">
                    <input type="file" name="scan_facture" 
                        class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-marsa-blue file:text-white
                        hover:file:bg-marsa-light-blue">
                </div>
            </div>

            <!-- Supplier Selection -->
            <div class="mb-6">
                <label for="fournisseur_id" class="block text-sm font-medium text-gray-700 mb-1">Fournisseur</label>
                <select name="fournisseur_id" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-marsa-blue focus:border-marsa-blue">
                    <option value="">Choisir un fournisseur</option>
                    @foreach($fournisseurs as $fournisseur)
                        <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Amounts Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="montant_ht" class="block text-sm font-medium text-gray-700 mb-1">Montant HT</label>
                    <input type="number" step="0.01" id="montant_ht" name="montant_ht" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-marsa-blue focus:border-marsa-blue"
                        value="{{ old('montant_ht') }}">
                </div>
                <div>
                    <label for="taux_tva" class="block text-sm font-medium text-gray-700 mb-1">TVA (%)</label>
                    <select id="taux_tva" name="taux_tva" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-marsa-blue focus:border-marsa-blue">
                        <option value="20" {{ old('taux_tva', 20) == 20 ? 'selected' : '' }}>20%</option>
                        <option value="14" {{ old('taux_tva') == 14 ? 'selected' : '' }}>14%</option>
                        <option value="10" {{ old('taux_tva') == 10 ? 'selected' : '' }}>10%</option>
                        <option value="8" {{ old('taux_tva') == 8 ? 'selected' : '' }}>6%</option>
                    </select>
                </div>
                <div>
                    <label for="montant_ttc" class="block text-sm font-medium text-gray-700 mb-1">Montant TTC</label>
                    <input type="number" step="0.01" id="montant_ttc" name="montant_ttc" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-marsa-blue focus:border-marsa-blue"
                        value="{{ old('montant_ttc') }}">
                </div>
            </div>

            <!-- Invoice Type -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Type Facture</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach(['M' => 'Marché', 'C' => 'Consultation', 'Ct' => 'Contrat', 'D' => 'Devis'] as $key => $label)
                        <label class="inline-flex items-center">
                            <input type="radio" name="type_facture" value="{{ $key }}"
                                {{ old('type_facture', 'D') == $key ? 'checked' : '' }}
                                class="h-4 w-4 text-marsa-blue focus:ring-marsa-blue border-gray-300">
                            <span class="ml-2 text-sm text-gray-700">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Additional Numbers -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="numero_bl_attachement" class="block text-sm font-medium text-gray-700 mb-1">N° BL/Attachement</label>
                    <input type="text" name="numero_bl_attachement" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-marsa-blue focus:border-marsa-blue"
                        value="{{ old('numero_bl_attachement') }}">
                </div>
                <div>
                    <label for="numero_marche_bc_devis" class="block text-sm font-medium text-gray-700 mb-1">N° Marché/BC/Devis</label>
                    <select name="numero_marche_bc_devis" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-marsa-blue focus:border-marsa-blue">
                        <option value="">Choisir un marché</option>
                        @foreach($marches as $marche)
                            <option value="{{ $marche->id }}">{{ $marche->marche_number }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Entity Selection -->
            <div class="mb-6">
                <label for="entite" class="block text-sm font-medium text-gray-700 mb-1">Entité</label>
                <select name="entite" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-marsa-blue focus:border-marsa-blue">
                    <option value="">Sélectionner une entité</option>
                    <option value="DE" {{ old('entite') == 'DE' ? 'selected' : '' }}>DE</option>
                    <option value="DOM" {{ old('entite') == 'DOM' ? 'selected' : '' }}>DOM</option>
                    <option value="GNV" {{ old('entite') == 'GNV' ? 'selected' : '' }}>GNV</option>
                    <option value="MM" {{ old('entite') == 'MM' ? 'selected' : '' }}>MM</option>
                    <option value="DSI" {{ old('entite') == 'DSI' ? 'selected' : '' }}>DSI</option>
                </select>
            </div>

            <!-- Remarks -->
            <div class="mb-8">
                <label for="remarque" class="block text-sm font-medium text-gray-700 mb-1">Remarque(s)</label>
                <textarea name="remarque" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-marsa-blue focus:border-marsa-blue">{{ old('remarque') }}</textarea>
            </div>

            <!-- Form Buttons -->
            <div class="flex justify-between">
                <button type="submit" 
                    class="px-6 py-2 bg-gradient-to-r from-marsa-blue to-marsa-light-blue text-white font-medium rounded-md hover:opacity-90 transition duration-300 shadow-md hover:shadow-lg">
                    Valider
                </button>
                <button type="reset" 
                    class="px-6 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 transition duration-300">
                    Réinitialiser
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const htInput = document.getElementById('montant_ht');
        const tvaInput = document.getElementById('taux_tva');
        const ttcInput = document.getElementById('montant_ttc');
        const dateReceptionInput = document.getElementById('date_reception_facture');
        const dateFactureInput = document.getElementById('date_facture');
        const numeroFactureInput = document.querySelector('input[name="numero_facture"]');
        const form = document.getElementById('factureForm');

        // Calculate TTC automatically
        function calculateTTC() {
            const ht = parseFloat(htInput.value) || 0;
            const tva = parseFloat(tvaInput.value) || 0;
            const ttc = ht + (ht * tva / 100);
            ttcInput.value = ttc.toFixed(2);
        }

        htInput.addEventListener('input', calculateTTC);
        tvaInput.addEventListener('input', calculateTTC);

        // Form validation
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const numeroFacture = numeroFactureInput.value.trim();
            const dateReception = new Date(dateReceptionInput.value);
            const dateFacture = new Date(dateFactureInput.value);

            const diffTime = dateReception - dateFacture;
            const diffDays = diffTime / (1000 * 3600 * 24);

            fetch(`/check-autorisation?numero_facture=${encodeURIComponent(numeroFacture)}`)
                .then(response => response.json())
                .then(data => {
                    const isAutorisee = data.autorisee === true;

                    if (!isAutorisee) {
                        if (diffDays > 5 || dateFacture > dateReception) {
                            alert('La date de la facture doit être dans les 5 jours suivant la date de réception.');
                            return;
                        }
                    }

                    form.submit();
                })
                .catch(error => {
                    console.error('Erreur serveur autorisation:', error);
                    alert('Erreur serveur. Veuillez réessayer.');
                });
        });
    });
</script>
@endsection