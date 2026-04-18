@extends('layouts.master')

@section('title', 'Demande d\'Autorisation')
@section('show-profile')
@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header section -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-marsa-blue">Demande d'Autorisation</h1>
            <p class="text-gray-600">Enregistrement de facture</p>
        </div>
        <div class="w-12 h-12 bg-marsa-light-blue bg-opacity-20 rounded-full flex items-center justify-center">
            <i class="fas fa-check-circle text-marsa-accent text-xl"></i>
        </div>
    </div>

    <!-- Main card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <!-- Card header with gradient -->
        <div class="bg-gradient-to-r from-marsa-blue to-marsa-light-blue px-6 py-4">
            <h2 class="text-white font-semibold text-lg">Nouvelle Demande</h2>
        </div>

        <!-- Form section -->
        <div class="p-6">
            <form action="{{ route('autorisation.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="date_creation" value="{{ now()->format('Y-m-d') }}">

                <!-- Numéro Facture Field -->
                <div class="mb-4">
                    <label for="numero_facture" class="block text-sm font-medium text-gray-700 mb-1">Numéro Facture</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-file-invoice text-gray-400"></i>
                        </div>
                        <input type="text" name="numero_facture" id="numero_facture" 
                               class="pl-10 w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2" 
                               placeholder="Saisir le numéro de facture" required>
                    </div>
                </div>

                <!-- Scan Facture Field -->
                <div class="mb-6">
                    <label for="scan_facture" class="block text-sm font-medium text-gray-700 mb-1">Scan Facture (PDF)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-file-pdf text-gray-400"></i>
                        </div>
                        <input type="file" name="scan_facture" id="scan_facture" 
                               class="pl-10 w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-marsa-light-blue file:text-white hover:file:bg-marsa-blue transition-all" 
                               accept="application/pdf" required>
                    </div>
                </div>

                <!-- Buttons (swapped as requested) -->
                <div class="flex justify-between">
                    <button type="submit" class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-all flex items-center space-x-2">
                        <i class="fas fa-check"></i>
                        <span>Valider</span>
                    </button>
                    <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition-all flex items-center space-x-2">
                        <i class="fas fa-arrow-left"></i>
                        <span>Retour</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection