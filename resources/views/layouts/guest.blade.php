<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Marsa Maroc') }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-form {
            animation: fadeIn 0.6s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-marsa-blue/10 to-gray-50 min-h-screen">
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden z-0">
        <div class="absolute inset-0 bg-[url('{{ asset('assets/images/marsa-pattern.png') }}')] opacity-10"></div>
    </div>

    <div class="relative z-10 min-h-screen flex flex-col items-center justify-center px-4 py-12">
        <!-- Display errors -->
        @if($errors->any())
            <div class="w-full max-w-md mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Auth Card -->
        <div class="w-full max-w-md bg-white/90 backdrop-blur-sm rounded-xl shadow-xl overflow-hidden animate-form">
            <!-- Header -->
            <div class="bg-marsa-blue p-6 text-center">
                <!-- <img src="{{ asset('assets/images/logo-marsa.png') }}" alt="Marsa Maroc" class="h-16 mx-auto"> -->
                <h2 class="mt-4 text-2xl font-bold text-white">
                    {{ $header ?? __('Bienvenue') }}
                </h2>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>