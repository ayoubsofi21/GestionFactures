<x-guest-layout>
    <x-slot name="header">
        {{ __('Créer un compte') }}
    </x-slot>

    <form method="POST" action="{{ route('register') }}" class="space-y-5 max-w-xl mx-auto">
        @csrf

        <!-- Name -->
        <div class="space-y-2 relative">
            <x-input-label for="name" :value="__('Nom complet')" class="text-gray-700" />
            <div class="relative">
                <x-text-input 
                    id="name" 
                    class="block w-full px-4 py-2 rounded-lg border-gray-300 focus:border-marsa-blue focus:ring focus:ring-marsa-blue/50 transition pl-10"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required 
                    autofocus 
                    autocomplete="name"
                    placeholder="Votre nom"
                />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-600" />
        </div>

        <!-- User Type -->
        <div class="space-y-2 relative">
            <x-input-label for="user_type" :value="__('Rôle utilisateur')" class="text-gray-700" />
            <div class="relative">
                <select 
                    id="user_type" 
                    name="user_type" 
                    required
                    class="block w-full px-4 py-2 rounded-lg border-gray-300 focus:border-marsa-blue focus:ring focus:ring-marsa-blue/50 transition appearance-none pl-10"
                >
                    <option value="" disabled selected>-- Sélectionner un rôle --</option>
                    <option value="Directeur">Directeur</option>
                    <option value="Administrateur">Administrateur</option>
                    <option value="Employe">Employé</option>
                    <option value="Financier">Financier</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('user_type')" class="mt-1 text-red-600" />
        </div>

        <!-- Email -->
        <div class="space-y-2 relative">
            <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
            <div class="relative">
                <x-text-input 
                    id="email" 
                    class="block w-full px-4 py-2 rounded-lg border-gray-300 focus:border-marsa-blue focus:ring focus:ring-marsa-blue/50 transition pl-10"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autocomplete="email"
                    placeholder="email@example.com"
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600" />
        </div>

        <!-- Password -->
        <div class="space-y-2 relative">
            <x-input-label for="password" :value="__('Mot de passe')" class="text-gray-700" />
            <div class="relative">
                <x-text-input 
                    id="password" 
                    class="block w-full px-4 py-2 rounded-lg border-gray-300 focus:border-marsa-blue focus:ring focus:ring-marsa-blue/50 transition pl-10"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2 relative">
            <x-input-label for="password_confirmation" :value="__('Confirmer mot de passe')" class="text-gray-700" />
            <div class="relative">
                <x-text-input 
                    id="password_confirmation" 
                    class="block w-full px-4 py-2 rounded-lg border-gray-300 focus:border-marsa-blue focus:ring focus:ring-marsa-blue/50 transition pl-10"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-600" />
        </div>

        <div class="flex items-center justify-between pt-4">
            <a href="{{ route('login') }}" class="text-sm text-marsa-blue hover:underline flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                {{ __('Déjà inscrit?') }}
            </a>

            <div class="flex space-x-4">
                <a href="/" class="px-4 py-2 flex items-center text-sm text-marsa-blue hover:text-marsa-navy transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10..." />
                    </svg>
                    {{ __('Accueil') }}
                </a>

                <button type="submit" class="px-4 py-2 bg-marsa-blue text-white rounded-lg hover:bg-marsa-navy transition">
                    {{ __('S’inscrire') }}
                </button>
            </div>
        </div>
    </form>
</x-guest-layout>
