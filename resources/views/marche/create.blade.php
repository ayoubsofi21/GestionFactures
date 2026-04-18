@extends('layouts.master')

@section('title', 'Gestion des Marchés')
@section('show-profile')
@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header section -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-marsa-blue">Gestion des Marchés</h1>
            <p class="text-gray-600">Enregistrement et consultation des marchés</p>
        </div>
        <div class="w-12 h-12 bg-marsa-light-blue bg-opacity-20 rounded-full flex items-center justify-center">
            <i class="fas fa-briefcase text-marsa-accent text-xl"></i>
        </div>
    </div>

    <!-- Main card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <!-- Card header with gradient -->
        <div class="bg-gradient-to-r from-marsa-blue to-marsa-light-blue px-6 py-4">
            <h2 class="text-white font-semibold text-lg">Nouveau Marché</h2>
        </div>

        <!-- Form section -->
        <div class="p-6">
            <form action="{{ route('marche.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Numéro Marché -->
                    <div>
                        <label for="numero" class="block text-sm font-medium text-gray-700 mb-1">N° Marché</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-hashtag text-gray-400"></i>
                            </div>
                            <input type="text" id="numero" name="marche_number" class="pl-10 w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2" 
                                   placeholder="Ex: MCH2024-001" required>
                        </div>
                    </div>

                    <!-- Objet -->
                    <div>
                        <label for="objet" class="block text-sm font-medium text-gray-700 mb-1">Objet</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-file-alt text-gray-400"></i>
                            </div>
                            <input type="text" id="objet" name="object" class="pl-10 w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2" 
                                   placeholder="Objet du marché" required>
                        </div>
                    </div>

                    <!-- Titulaire -->
                    <div>
                        <label for="titulaire" class="block text-sm font-medium text-gray-700 mb-1">Titulaire</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-building text-gray-400"></i>
                            </div>
                            <input type="text" id="titulaire" name="tutilier" class="pl-10 w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2" 
                                   placeholder="Nom du titulaire" required>
                        </div>
                    </div>

                    <!-- Délai Paiement -->
                    <div>
                        <label for="delai_paiement" class="block text-sm font-medium text-gray-700 mb-1">Délai Paiement</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar-alt text-gray-400"></i>
                            </div>
                            <select id="delai_paiement" name="payment_delay" class="pl-10 w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2">
                                <option value="30">30 jours</option>
                                <option value="60" selected>60 jours</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('marche.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition-all">
                        <i class="fas fa-redo mr-2"></i>
                        Initialiser
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-all">
                        <i class="fas fa-check-circle mr-2"></i>
                        Valider
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Results Section -->
    <div class="mt-8 bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <!-- Card header with gradient -->
        <div class="bg-gradient-to-r from-marsa-blue to-marsa-light-blue px-6 py-4">
            <h2 class="text-white font-semibold text-lg">Liste des Marchés</h2>
        </div>

        <div class="p-6">
            @if($marches->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N° Marché</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Objet</th>
                           
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($marches as $marche)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $marche->marche_number }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $marche->object }}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-8 bg-gray-50 rounded-lg">
                <i class="fas fa-box-open text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700">Aucun marché enregistré</h3>
                <p class="text-gray-500 mt-1">Utilisez le formulaire ci-dessus pour ajouter un nouveau marché</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection