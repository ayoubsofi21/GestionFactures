@extends('layouts.master')

@section('title', 'Gestion des Fournisseurs')
@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-marsa-blue">Gestion des Fournisseurs</h1>
            <p class="text-gray-600 mt-1">Gérez vos partenaires fournisseurs</p>
        </div>
        <div class="w-10 h-10 bg-marsa-light-blue bg-opacity-20 rounded-full flex items-center justify-center">
            <i class="fas fa-truck text-marsa-accent"></i>
        </div>
    </div>

    <!-- Main card -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
        <!-- Card header -->
        <div class="bg-gradient-to-r from-marsa-blue to-marsa-light-blue px-6 py-3">
            <h2 class="text-white font-medium">Enregistrement et Recherche</h2>
        </div>

        <!-- Form section -->
        <div class="p-5">
            <form action="{{ route('fournisseur.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <!-- Fournisseur Field -->
                    <div class="md:col-span-5">
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Fournisseur</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-building text-gray-400"></i>
                            </div>
                            <input type="text" name="nom" id="nom" class="pl-10 w-full rounded-md border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2" 
                                   placeholder="Nom du fournisseur" value="{{ request('nom') }}">
                        </div>
                    </div>

                    <!-- ICE Field -->
                    <div class="md:col-span-4">
                        <label for="ice" class="block text-sm font-medium text-gray-700 mb-1">ICE</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-id-card text-gray-400"></i>
                            </div>
                            <input type="text" name="ice" id="ice" class="pl-10 w-full rounded-md border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2" 
                                   placeholder="Numéro ICE" value="{{ request('ice') }}">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="md:col-span-3 flex items-end space-x-2">
                        <button type="submit" name="action" value="ajouter" 
                                class="flex-1 bg-green-500 hover:bg-green-600 text-white py-2 px-3 rounded-md transition-all flex items-center justify-center space-x-2 text-sm">
                            <i class="fas fa-plus"></i>
                            <span>Ajouter</span>
                        </button>
                        <button type="submit" name="action" value="rechercher" 
                                class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded-md transition-all flex items-center justify-center space-x-2 text-sm">
                            <i class="fas fa-search"></i>
                            <span>Rechercher</span>
                        </button>
                    </div>
                </div>

                <!-- Reset Button -->
                <div class="mt-3 text-right">
                    <a href="{{ route('fournisseur.create') }}" 
                       class="inline-flex items-center px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-all text-sm">
                        <i class="fas fa-redo mr-1.5"></i>
                        Initialiser
                    </a>
                </div>
            </form>

            <!-- Results Section -->
            @if($fournisseurs->count() > 0)
            <div class="mt-6 overflow-x-auto rounded-md border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Fournisseur</th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">ICE</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($fournisseurs as $fournisseur)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $fournisseur->nom }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $fournisseur->ice }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="mt-6 text-center py-8 bg-gray-50 rounded-md">
                <i class="fas fa-box-open text-4xl text-gray-400 mb-3"></i>
                <h3 class="text-lg font-medium text-gray-700">Aucun fournisseur trouvé</h3>
                <p class="text-gray-500 mt-1 text-sm">Utilisez le formulaire pour ajouter ou rechercher</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection