@extends('layouts.master')

@section('title', 'Tableau de Bord')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
    <!-- Main Content -->
    <div class="container mx-auto px-4 h-screen flex flex-col justify-center">
        <!-- Welcome Message -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-marsa-blue mb-4 animate-fade-in">
                Bienvenue ,     <span class="text-marsa-accent">{{ Auth::user()->name }}</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Votre portail de gestion Marsa Maroc
            </p>
        </div>

        <!-- Hero Illustration -->
        <div class="relative h-96 md:h-[500px] w-full max-w-6xl mx-auto">
            <div class="absolute inset-0 bg-white/30 backdrop-blur-sm rounded-3xl shadow-2xl overflow-hidden border border-white/20">
                <img src="{{ asset('assets/images/file.svg') }}" 
                     alt="Dashboard Illustration" 
                     class="w-full h-full object-contain p-8 transform transition-all duration-500 hover:scale-105">
            </div>
            
            <!-- Floating elements for visual interest -->
            <div class="absolute -top-6 -left-6 w-24 h-24 rounded-full bg-marsa-accent/10 blur-xl"></div>
            <div class="absolute -bottom-6 -right-6 w-32 h-32 rounded-full bg-marsa-blue/10 blur-xl"></div>
        </div>

        <!-- Subtle CTA -->
        <div class="text-center mt-12 animate-fade-in-up">
            <p class="text-gray-500 mb-4">Commencez à naviguer avec le menu latéral</p>
            <div class="animate-bounce">
                <i class="fas fa-arrow-left text-marsa-accent text-xl"></i>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 1s ease-out forwards;
    }
    .animate-fade-in-up {
        animation: fadeInUp 1s ease-out forwards;
    }
    .animate-bounce {
        animation: bounce 2s infinite;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes bounce {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(-10px); }
    }
</style>
@endsection