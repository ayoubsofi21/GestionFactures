@extends('layouts.master')

@section('title', 'Consultation des Factures')
@section('show-profile')
@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header section -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-marsa-blue">Consultation des Factures</h1>
            <p class="text-gray-600">Recherche et visualisation des factures</p>
        </div>
        <div class="w-12 h-12 bg-marsa-light-blue bg-opacity-20 rounded-full flex items-center justify-center">
            <i class="fas fa-search text-marsa-accent text-xl"></i>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 mb-6">
        <!-- Card header with gradient -->
        <div class="bg-gradient-to-r from-marsa-blue to-marsa-light-blue px-6 py-4">
            <h2 class="text-white font-semibold text-lg">Filtres de Recherche</h2>
        </div>

        <!-- Form section -->
        <div class="p-6">
            <form method="GET" action="{{ route('consultation') }}">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <!-- Entité Field -->
                    <div class="md:col-span-3">
                        <label for="entite" class="block text-sm font-medium text-gray-700 mb-1">Entité</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-building text-gray-400"></i>
                            </div>
                            <select id="entite" name="entite" class="pl-10 w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2">
                                <option value="">Toutes les entités</option>
                                <option value="DE" {{ ($filters['entite'] ?? '') == 'DE' ? 'selected' : '' }}>DE</option>
                                <option value="DOM" {{ ($filters['entite'] ?? '') == 'DOM' ? 'selected' : '' }}>DOM</option>
                                <option value="GNV" {{ ($filters['entite'] ?? '') == 'GNV' ? 'selected' : '' }}>GNV</option>
                                <option value="MM" {{ ($filters['entite'] ?? '') == 'MM' ? 'selected' : '' }}>MM</option>
                                <option value="DSI" {{ ($filters['entite'] ?? '') == 'DSI' ? 'selected' : '' }}>DSI</option>
                            </select>
                        </div>
                    </div>

                    <!-- Critère Field -->
                    <div class="md:col-span-3">
                        <label for="recherche" class="block text-sm font-medium text-gray-700 mb-1">Critère</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-filter text-gray-400"></i>
                            </div>
                            <select id="recherche" name="recherche" class="pl-10 w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2">
                                <option value="">Choisir un critère</option>
                                <option value="date_emission" {{ ($filters['recherche'] ?? '') == 'date_emission' ? 'selected' : '' }}>Date Émission</option>
                                <!-- Add other criteria as needed -->
                            </select>
                        </div>
                    </div>

                    <!-- Valeur Field -->
                    <div class="md:col-span-4">
                        <label for="valeur" class="block text-sm font-medium text-gray-700 mb-1">Valeur</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" id="valeur" name="valeur" class="pl-10 w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2" 
                                   placeholder="Entrez la valeur" 
                                   value="{{ $filters['valeur'] ?? '' }}"
                                   {{ empty($filters['recherche']) ? 'disabled' : '' }}>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="md:col-span-2 flex items-end">
                        <button type="submit" id="btn-recherche" class="w-full bg-marsa-accent hover:bg-marsa-blue text-white py-2 px-4 rounded-lg transition-all flex items-center justify-center space-x-2"
                                {{ (!empty($filters['recherche']) && empty($filters['valeur'])) ? 'disabled' : '' }}>
                            <i class="fas fa-search"></i>
                            <span>Rechercher</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Results Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <!-- Card header with gradient -->
        <div class="bg-gradient-to-r from-marsa-blue to-marsa-light-blue px-6 py-4">
            <div class="flex justify-between items-center">
                <h2 class="text-white font-semibold text-lg">Résultats des Factures</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('consultation') }}" class="text-white hover:text-gray-200 transition-colors">
                        <i class="fas fa-sync-alt"></i>
                    </a>
                    <a href="#" class="text-white hover:text-gray-200 transition-colors">
                        <i class="fas fa-file-excel"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Table section -->
        <div class="p-6">
            @if($factures->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Réception</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Émission</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fournisseur</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Facture</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">HT</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TTC</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entité</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Délai</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PDF</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($factures as $facture)
                        <tr class="{{ $facture->marche && $facture->marche->payment_delay > 60 ? 'bg-red-50' : ($facture->marche && $facture->marche->payment_delay > 30 ? 'bg-yellow-50' : 'hover:bg-gray-50') }} transition-colors">
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $facture->date_reception_facture }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $facture->date_facture }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $facture->fournisseur->nom }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $facture->numero_facture }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ number_format($facture->montant_ht, 2) }} DH</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ number_format($facture->montant_ttc, 2) }} DH</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $facture->entite }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ (int)$facture->payment_delay }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                @if($facture->scan_facture)
                                    <a href="{{ asset('storage/' . $facture->scan_facture) }}" target="_blank" class="text-marsa-accent hover:text-marsa-blue transition-colors">
                                        <i class="fas fa-file-pdf text-lg"></i>
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-8 bg-gray-50 rounded-lg">
                <i class="fas fa-file-invoice text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700">Aucune facture trouvée</h3>
                <p class="text-gray-500 mt-1">Modifiez vos critères de recherche pour afficher des résultats</p>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('recherche');
        const input = document.getElementById('valeur');
        const button = document.getElementById('btn-recherche');

        select.addEventListener('change', function() {
            if (this.value !== '') {
                input.disabled = false;
                input.focus();
            } else {
                input.disabled = true;
                input.value = '';
                button.disabled = false;
            }
        });

        input.addEventListener('input', function() {
            button.disabled = select.value !== '' && this.value.trim() === '';
        });
    });
</script>
@endsection