@extends('layouts.master')

@section('title', 'Mon Profil')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-marsa-light-blue bg-opacity-20 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-user-cog text-marsa-accent text-xl"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Bonjour, {{ Auth::user()->name }}</h1>
                <p class="text-gray-600">Gérez vos informations de compte</p>
            </div>
        </div>

        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-all text-sm font-medium">
            <i class="fas fa-arrow-left mr-2"></i> Retour
        </a>
    </div>

    <!-- Profile Sections -->
    <div class="space-y-6">
        <!-- Profile Information Card -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
            <div class="bg-marsa-blue px-6 py-4 flex items-center">
                <div class="w-10 h-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center mr-3">
                    <i class="fas fa-user text-white"></i>
                </div>
                <h2 class="text-white font-semibold text-lg">Informations personnelles</h2>
            </div>
            <div class="p-6">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Password Update Card -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
            <div class="bg-marsa-blue px-6 py-4 flex items-center">
                <div class="w-10 h-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center mr-3">
                    <i class="fas fa-lock text-white"></i>
                </div>
                <h2 class="text-white font-semibold text-lg">Sécurité du compte</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @include('profile.partials.update-password-form')
                    
                    <!-- Two-Factor Authentication Section -->
                    <div class="border-t border-gray-100 pt-4">
                        <h3 class="font-medium text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-shield-alt text-marsa-accent mr-2"></i>
                            Authentification à deux facteurs
                        </h3>
                        <div class="flex items-start">
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 mb-2">
                                    Améliorez la sécurité de votre compte en activant l'authentification à deux facteurs.
                                </p>
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                    Recommandé
                                </span>
                            </div>
                            <button class="ml-4 inline-flex items-center px-3 py-1 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-marsa-accent">
                                Activer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danger Zone Card -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-red-200">
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4 flex items-center">
                <div class="w-10 h-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center mr-3">
                    <i class="fas fa-exclamation-triangle text-white"></i>
                </div>
                <h2 class="text-white font-semibold text-lg">Zone sensible</h2>
            </div>
            <div class="p-6">
                <div class="space-y-6">
                    <!-- Session Management -->
                    <div>
                        <h3 class="font-medium text-gray-700 mb-3">Sessions actives</h3>
                        <div class="text-sm text-gray-600 mb-2">
                            Gérer et déconnecter vos sessions actives sur d'autres navigateurs et appareils.
                        </div>
                        <button onclick="document.getElementById('logoutOtherDevicesForm').submit();" class="inline-flex items-center px-3 py-1 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            <i class="fas fa-sign-out-alt mr-2 text-red-500"></i>
                            Déconnecter toutes les autres sessions
                        </button>
                    </div>

                    <!-- Account Deletion -->
                    <div class="border-t border-gray-100 pt-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden form for logging out other devices -->
<form id="logoutOtherDevicesForm" action="#" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<style>
    /* Smooth transitions for form elements */
    input:focus, button:focus, select:focus {
        transition: all 0.2s ease;
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.2);
    }
</style>
@endsection