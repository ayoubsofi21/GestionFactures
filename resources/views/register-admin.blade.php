@extends('layouts.master')

@section('title', 'Créer un compte')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="w-20 h-20 bg-marsa-light-blue bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-plus text-marsa-accent text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-marsa-blue">
                Créer un compte
            </h2>
            <p class="mt-2 text-gray-600">
                Remplissez les informations pour créer un nouveau compte
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-marsa-blue to-marsa-light-blue px-6 py-4">
                <h3 class="text-white font-semibold text-lg flex items-center">
                    <i class="fas fa-user-shield mr-2"></i> Informations du compte
                </h3>
            </div>
            
            <form method="POST" action="{{ route('register-admin.store') }}" class="p-6 space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input 
                            id="name" 
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required 
                            autofocus 
                            autocomplete="name"
                            placeholder="Votre nom complet"
                            class="pl-10 w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2"
                        >
                    </div>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- User Type -->
                <div>
                    <label for="user_type" class="block text-sm font-medium text-gray-700 mb-1">Rôle utilisateur</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user-tag text-gray-400"></i>
                        </div>
                        <select 
                            id="user_type" 
                            name="user_type" 
                            required
                            class="pl-10 w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2 appearance-none"
                        >
                            <option value="" disabled selected>-- Sélectionner un rôle --</option>
                            <option value="Directeur" {{ old('user_type') == 'Directeur' ? 'selected' : '' }}>Directeur</option>
                            <option value="Administrateur" {{ old('user_type') == 'Administrateur' ? 'selected' : '' }}>Administrateur</option>
                            <option value="Employe" {{ old('user_type') == 'Employe' ? 'selected' : '' }}>Employé</option>
                            <option value="Financier" {{ old('user_type') == 'Financier' ? 'selected' : '' }}>Financier</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                    @error('user_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input 
                            id="email" 
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            placeholder="email@example.com"
                            class="pl-10 w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2"
                        >
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input 
                            id="password" 
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="pl-10 w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2"
                        >
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmer mot de passe</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input 
                            id="password_confirmation" 
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="pl-10 w-full rounded-lg border-gray-300 focus:border-marsa-accent focus:ring focus:ring-marsa-accent focus:ring-opacity-50 py-2"
                        >
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-between items-center pt-4 space-y-4 sm:space-y-0">
                    <div class="flex space-x-3">
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 flex items-center">
                            <i class="fas fa-home mr-1"></i> Accueil
                        </a>
                        <button type="submit" class="px-6 py-2 bg-marsa-accent hover:bg-marsa-blue text-white rounded-lg transition-all flex items-center">
                            <i class="fas fa-user-plus mr-2"></i> Créer le compte
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection