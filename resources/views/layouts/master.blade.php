<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Factures - Marsa Maroc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'marsa-blue': '#003366',
                        'marsa-light-blue': '#0066cc',
                        'marsa-accent': '#0066cc', // Changed from gold to light blue
                        'marsa-dark-blue': '#001a33',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .sidebar-link.active {
            background-color: rgba(0, 102, 204, 0.2); /* Changed from gold to light blue */
            border-left: 4px solid #0066cc; /* Changed from gold to light blue */
        }
        
        .sidebar-link:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.05);
        }
        
        /* Smooth transitions - kept exactly the same */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Mobile header - same structure, color changed -->
    <header class="lg:hidden bg-marsa-blue text-white shadow-md">
        <div class="flex items-center justify-between px-4 py-3">
            <div class="flex items-center space-x-2">
                <i class="fas fa-file-invoice text-marsa-accent text-xl"></i>
                <span class="font-bold text-lg">Marsa Factures</span>
            </div>
            <button id="mobile-menu-button" class="text-white focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </header>

    <div class="flex h-screen overflow-hidden">
        <!-- Desktop Sidebar - same structure, color changed -->
        <aside id="sidebar" class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-64 bg-marsa-blue text-white">
                <!-- Logo -->
                <div class="flex items-center justify-center h-16 px-4 border-b border-marsa-dark-blue">
                    <a href="{{ route('dashboard') }}">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-file-invoice text-marsa-accent text-2xl"></i>
                        <span class="font-bold text-xl">Marsa Factures</span>
                    </div>
                    </a>
                </div>
                
                <!-- User info -->
                <!-- <div class="px-4 py-3 flex items-center space-x-3 border-b border-marsa-dark-blue">
                    <div class="w-10 h-10 rounded-full bg-marsa-accent flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-300">{{ Auth::user()->user_type }}</p>
                    </div>
                </div>
                 -->
                <!-- Navigation -->
                    <nav class="flex-1 overflow-y-auto py-4">
                    <ul class="space-y-1 px-2">
                            <!-- Facture Registration (Admin + Director) -->
                            @if(in_array(Auth::user()->user_type, [ 'Administrateur']))
                            <li>
                                <a href="{{ route('factures.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('factures.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                    <i class="fas fa-file-import mr-3 text-marsa-accent"></i>
                                    Enregistrer Facture
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('autorisation.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('autorisation.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                    <i class="fas fa-check-circle mr-3 text-marsa-accent"></i>
                                    Autorisation
                                </a>
                            </li>
                        
                            @endif

                            <!-- Supplier & Market (Employee + Admin + Director) -->
                            @if(in_array(Auth::user()->user_type, ['Employe', ]))
                            <li>
                                <a href="{{ route('fournisseur.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('fournisseur.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                    <i class="fas fa-truck mr-3 text-marsa-accent"></i>
                                    Fournisseur
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('marche.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('marche.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                    <i class="fas fa-briefcase mr-3 text-marsa-accent"></i>
                                    Marché
                                </a>
                            </li>
                            @endif
                            
                            <!-- Consultation (All users) -->
                            
                            
                            <!-- Authorization (Director only) -->
                            @if(Auth::user()->user_type === 'Directeur')
                            <li>
                            <a href="{{ route('factures.create') }}" 
                            class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('factures.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                <i class="fas fa-file-import mr-3 text-marsa-accent"></i>
                                Enregistrer Facture
                            </a>

                            </li> 
                            <li>
                                <a href="{{ route('consultation') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('consultation') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                    <i class="fas fa-search mr-3 text-marsa-accent"></i>
                                    Consultation
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('fournisseur.create') }}"
                                 class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('fournisseur.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                    <i class="fas fa-truck mr-3 text-marsa-accent"></i>
                                    Fournisseur
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('marche.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('marche.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                    <i class="fas fa-briefcase mr-3 text-marsa-accent"></i>
                                    Marché
                                </a>
                            </li>
                            
                            <li>
                                <a href="{{ route('autorisation.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('autorisation.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                    <i class="fas fa-check-circle mr-3 text-marsa-accent"></i>
                                    Autorisation
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('factureAuto.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('factureAuto.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                    <i class="fas fa-sitemap mr-3 text-marsa-accent"></i>
                                    Instances
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('factureAuto.index') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('factureAuto.index') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                    <i class="fas fa-tasks mr-3 text-marsa-accent"></i>
                                    Liste_F_Aut
                                </a>
                            </li>

                            <!-- Hors Délais (All users) -->
                            <li>
                                <a href="{{ route('factures.hors-delai') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('factures.hors-delai') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                    <i class="fas fa-clock mr-3 text-marsa-accent"></i>
                                    Hors Délais
                                </a>
                            </li>
                            @endif

                            <!-- Instances (Financial + Director) -->
                            @if(in_array(Auth::user()->user_type, ['Financier',]))
                            <li>
                                <a href="{{ route('factureAuto.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('factureAuto.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                    <i class="fas fa-sitemap mr-3 text-marsa-accent"></i>
                                    Instances
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('factureAuto.index') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('factureAuto.indexe') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                    <i class="fas fa-tasks mr-3 text-marsa-accent"></i>
                                    Liste_F_Aut
                                </a>
                            </li>
                            @endif
                            <!-- Create Account (Admin + Director) -->
                            @if(in_array(Auth::user()->user_type, ['Directeur', ]))
                            <li>
                                <a href="{{ route('register-admin') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all hover:bg-white hover:bg-opacity-10 group">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 flex items-center justify-center mr-3">
                                            <i class="fas fa-user-plus text-marsa-accent group-hover:text-white transition-colors"></i>
                                        </div>
                                        <span class="text-white group-hover:text-marsa-accent transition-colors">Create Account</span>
                                    </div>
                                    <span class="ml-auto bg-marsa-accent text-white text-xs font-bold px-2 py-1 rounded-full">Admin</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </nav>
                
                <!-- Logout -->
                <div class="p-4 border-t border-marsa-dark-blue">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-opacity-20 bg-marsa-accent rounded-md hover:bg-opacity-30 transition-all">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Mobile sidebar (hidden by default) - same structure, color changed -->
        <div id="mobile-sidebar" class="hidden fixed inset-0 z-40 lg:hidden">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>
            <div class="fixed inset-y-0 left-0 flex max-w-xs w-full">
                <div class="flex flex-col w-64 bg-marsa-blue text-white">
                    <div class="flex items-center justify-between h-16 px-4 border-b border-marsa-dark-blue">
                        <a href="{{ route('dashboard') }}">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-file-invoice text-marsa-accent text-xl"></i>
                            <span class="font-bold text-lg">Marsa Factures</span>
                        </div>
                        </a>
                        <button id="close-mobile-menu" class="text-white focus:outline-none">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <div class="flex-1 overflow-y-auto py-4">
                    <ul class="space-y-1 px-2">
                        <!-- Facture Registration (Admin + Director) -->
                        @if(in_array(Auth::user()->user_type, [ 'Administrateur']))
                        <li>
                            <a href="{{ route('factures.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('factures.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                <i class="fas fa-file-import mr-3 text-marsa-accent"></i>
                                Enregistrer Facture
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('autorisation.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('autorisation.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                <i class="fas fa-check-circle mr-3 text-marsa-accent"></i>
                                Autorisation
                            </a>
                        </li>
                       
                        @endif

                        <!-- Supplier & Market (Employee + Admin + Director) -->
                        @if(in_array(Auth::user()->user_type, ['Employe', ]))
                        <li>
                            <a href="{{ route('fournisseur.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('fournisseur.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                <i class="fas fa-truck mr-3 text-marsa-accent"></i>
                                Fournisseur
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('marche.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('marche.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                <i class="fas fa-briefcase mr-3 text-marsa-accent"></i>
                                Marché
                            </a>
                        </li>
                        @endif
                        
                        <!-- Consultation (All users) -->
                        
                        
                        <!-- Authorization (Director only) -->
                        @if(Auth::user()->user_type === 'Directeur')
                        <li>
                            <a href="{{ route('factures.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('factures.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                <i class="fas fa-file-import mr-3 text-marsa-accent"></i>
                                Enregistrer Facture
                            </a>
                        </li>
                         <li>
                            <a href="{{ route('consultation') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('consultation') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                <i class="fas fa-search mr-3 text-marsa-accent"></i>
                                Consultation
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('fournisseur.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('fournisseur.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                <i class="fas fa-truck mr-3 text-marsa-accent"></i>
                                Fournisseur
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('marche.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('marche.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                <i class="fas fa-briefcase mr-3 text-marsa-accent"></i>
                                Marché
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('autorisation.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('autorisation.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                <i class="fas fa-check-circle mr-3 text-marsa-accent"></i>
                                Autorisation
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('factureAuto.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('factureAuto.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                <i class="fas fa-sitemap mr-3 text-marsa-accent"></i>
                                Instances
                            </a>
                        </li>
                       
                        <li>
                            <a href="{{ route('factureAuto.index') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('factureAuto.index') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                <i class="fas fa-tasks mr-3 text-marsa-accent"></i>
                                Liste_F_Aut
                            </a>
                        </li>

                        <!-- Hors Délais (All users) -->
                        <li>
                            <a href="{{ route('factures.hors-delai') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('factures.hors-delai') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                <i class="fas fa-clock mr-3 text-marsa-accent"></i>
                                Hors Délais
                            </a>
                        </li>
                        @endif

                        <!-- Instances (Financial + Director) -->
                        @if(in_array(Auth::user()->user_type, ['Financier',]))
                        <li>
                            <a href="{{ route('factureAuto.create') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('factureAuto.create') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                <i class="fas fa-sitemap mr-3 text-marsa-accent"></i>
                                Instances
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('factureAuto.index') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all {{ request()->routeIs('factureAuto.index') ? 'bg-white bg-opacity-10 text-marsa-accent' : '' }}">
                                <i class="fas fa-tasks mr-3 text-marsa-accent"></i>
                                Liste_F_Aut
                            </a>
                        </li>
                        @endif
                        <!-- Create Account (Admin + Director) -->
                        @if(in_array(Auth::user()->user_type, ['Directeur', ]))
                        <li>
                            <a href="{{ route('register-admin') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all hover:bg-white hover:bg-opacity-10 group">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 flex items-center justify-center mr-3">
                                        <i class="fas fa-user-plus text-marsa-accent group-hover:text-white transition-colors"></i>
                                    </div>
                                    <span class="text-white group-hover:text-marsa-accent transition-colors">Create Account</span>
                                </div>
                                <span class="ml-auto bg-marsa-accent text-white text-xs font-bold px-2 py-1 rounded-full">Admin</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                    </div>
                    <div class="p-4 border-t border-marsa-dark-blue">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-opacity-20 bg-marsa-accent rounded-md hover:bg-opacity-30 transition-all">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content - same structure -->
        <div class="flex-1 overflow-auto">
            <!-- Content header -->
            <header class="bg-white shadow-sm">
    <div class="px-4 py-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-lg font-semibold text-gray-900">
            @yield('title', 'Tableau de bord')
        </h1>
        <div class="flex items-center space-x-4">
            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ isOpen: false }">
                <!-- Button -->
                <button 
                    @click="isOpen = !isOpen"
                    class="flex items-center space-x-2 rounded-full focus:outline-none transition"
                    aria-label="Menu utilisateur"
                >
                    <div class="w-10 h-10 rounded-full bg-marsa-accent text-white font-bold flex items-center justify-center">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="hidden md:inline text-gray-700 font-medium">
                        {{ Auth::user()->name }}
                    </span>
                    <i :class="isOpen ? 'fas fa-chevron-up text-marsa-accent' : 'fas fa-chevron-down text-gray-500'" class="ml-1"></i>
                </button>

                <!-- Dropdown -->
                <div
                    x-show="isOpen"
                    @click.outside="isOpen = false"
                    x-transition
                    class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-lg border border-gray-200 z-50"
                >
                    <!-- User Info -->
                    <div class="px-5 py-4 border-b border-gray-100 bg-gray-50">
                        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-marsa-accent font-medium">{{ Auth::user()->user_type }}</p>
                    </div>

                    <!-- Links -->
                    <div class="py-2">
                        <a 
                            href="{{ route('profile.edit') }}" 
                            @click="isOpen = false"
                            class="flex items-center px-5 py-2 text-sm text-gray-700 hover:bg-gray-100 transition"
                        >
                            <i class="fas fa-user-circle mr-3 text-marsa-accent w-4 text-center"></i>
                            Mon Profil
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button 
                                type="submit" 
                                class="w-full text-left flex items-center px-5 py-2 text-sm text-gray-700 hover:bg-gray-100 transition"
                            >
                                <i class="fas fa-sign-out-alt mr-3 text-red-500 w-4 text-center"></i>
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>



            <!-- Main content area -->
            <main class="p-4 sm:px-6 lg:px-8 py-6">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-center md:text-left mb-4 md:mb-0">
                        <p class="text-sm text-gray-600">&copy; {{ date('Y') }} Marsa Maroc - Gestion des Factures</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">Version 1.0.0</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- JavaScript - kept exactly the same -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-sidebar').classList.remove('hidden');
        });
        
        document.getElementById('close-mobile-menu').addEventListener('click', function() {
            document.getElementById('mobile-sidebar').classList.add('hidden');
        });
        
        // Set active link based on current URL
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const links = document.querySelectorAll('.sidebar-link');
            
            links.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
            
            // Close mobile menu when clicking a link
            document.querySelectorAll('#mobile-sidebar .sidebar-link').forEach(link => {
                link.addEventListener('click', () => {
                    document.getElementById('mobile-sidebar').classList.add('hidden');
                });
            });
        });
    </script>
</body>
</html>