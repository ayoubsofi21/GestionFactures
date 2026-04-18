@extends('layouts.master')

@section('title', 'Factures Hors Délai')
@section('show-profile')
@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header section -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-marsa-blue">Factures Hors Délai</h1>
            <p class="text-gray-600">Liste des factures dépassant les délais de paiement</p>
        </div>
        <div class="flex items-center space-x-4">
            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                Total: {{ count($factures) }} facture(s)
            </span>
            <button onclick="location.reload()" class="w-10 h-10 bg-marsa-light-blue bg-opacity-20 rounded-full flex items-center justify-center text-marsa-accent hover:bg-opacity-30 transition-all">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
    </div>

    <!-- Main card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <!-- Card header with gradient -->
        <div class="bg-gradient-to-r from-marsa-blue to-marsa-light-blue px-6 py-4">
            <h2 class="text-white font-semibold text-lg">Liste des Factures</h2>
        </div>

        <!-- Table section -->
        <div class="p-6">
            @if(count($factures) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reçue le</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Émission</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fournisseur</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Facture</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant HT</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant TTC</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entité</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Délai</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Document</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($factures as $facture)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $facture->date_reception_facture }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $facture->date_facture }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $facture->fournisseur->nom }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $facture->numero_facture }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ number_format($facture->montant_ht, 2, ',', ' ') }} DH</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ number_format($facture->montant_ttc, 2, ',', ' ') }} DH</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $facture->entite }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-red-600">{{ (int)$facture->payment_delay }} jours</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                <a href="{{ asset('storage/' . $facture->scan_facture) }}" target="_blank" class="text-marsa-accent hover:text-marsa-blue transition-colors inline-flex items-center">
                                    <i class="fas fa-file-pdf mr-1"></i> Voir
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-12 bg-gray-50 rounded-lg">
                <i class="fas fa-check-circle text-4xl text-green-400 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700">Aucune facture hors délai</h3>
                <p class="text-gray-500 mt-1">Toutes les factures sont traitées dans les délais</p>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Export options -->
    {{-- <div class="mt-6 flex justify-end">
        <div class="inline-flex rounded-md shadow-sm">
            <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-l-lg bg-white text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-marsa-accent focus:border-marsa-accent">
                <i class="fas fa-file-excel mr-2 text-green-600"></i> Exporter
            </button>
            <button type="button" class="-ml-px inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-lg bg-white text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-marsa-accent focus:border-marsa-accent">
                <i class="fas fa-print mr-2 text-gray-600"></i> Imprimer
            </button>
        </div>
    </div> --}}
</div>
@endsection