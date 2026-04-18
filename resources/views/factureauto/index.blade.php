@extends('layouts.master')

@section('title', 'Historique des Factures Autorisées')
@section('show-profile')
@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header section -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-marsa-blue">Historique des Factures</h1>
            <p class="text-gray-600">Liste des factures autorisées ou rejetées</p>
        </div>
        <div class="w-12 h-12 bg-marsa-light-blue bg-opacity-20 rounded-full flex items-center justify-center">
            <i class="fas fa-history text-marsa-accent text-xl" onclick="window.location.reload()"></i>
        </div>
    </div>

    <!-- Main card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <!-- Card header with gradient -->
        <div class="bg-gradient-to-r from-marsa-blue to-marsa-light-blue px-6 py-4">
            <div class="flex justify-between items-center">
                <h2 class="text-white font-semibold text-lg">Détails des Factures</h2>
                <div class="flex items-center space-x-2">
                    <span class="text-white text-sm bg-white bg-opacity-20 px-2 py-1 rounded">
                        Total: {{ count($factures ?? []) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Table section -->
        <div class="p-6">
            @if(!empty($factures) && count($factures) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Facture</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autorisation</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reçue le</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Saisie le</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Document</th>
                            {{-- <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titulaire</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">HT</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TTC</th> --}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($factures as $data)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $data->numero_facture }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $data->numero_autorisation ?? '-' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $data->date_creation ?? '-' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $data->date_saisie ?? '-' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                @if($data->motif_rejet)
                                <span class="px-2 py-1 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                    Rejetée
                                </span>
                                @else
                                <span class="px-2 py-1 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                    Autorisée
                                </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                @if($data->scan_facture)
                                <a href="{{ asset('storage/' . $data->scan_facture) }}" target="_blank" class="text-marsa-accent hover:text-marsa-blue transition-colors inline-flex items-center">
                                    <i class="fas fa-file-pdf mr-1"></i> Voir
                                </a>
                                @else
                                <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            {{-- <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $data->titulaire ?? '-' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ number_format($data->montant_ht, 2) }} DH
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ number_format($data->montant_ttc, 2) }} DH
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-12 bg-gray-50 rounded-lg">
                <i class="fas fa-file-invoice text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700">Aucune facture disponible</h3>
                <p class="text-gray-500 mt-1">Aucune facture n'a été enregistrée pour le moment</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Action buttons -->
    <div class="mt-6 flex flex-col sm:flex-row justify-between gap-3">
        <div class="flex gap-3">
            <button onclick="window.location.reload()" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all flex items-center justify-center">
                <i class="fas fa-sync-alt mr-2"></i> Rafraîchir
            </button>
        </div>
        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition-all flex items-center justify-center">
            <i class="fas fa-arrow-left mr-2"></i> Retour
        </a>
    </div>
</div>
@endsection