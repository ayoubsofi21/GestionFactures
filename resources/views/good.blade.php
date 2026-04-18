<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Marsa Maroc - Gestion Des Facture </title>
  
  <!-- Tailwind CSS via CDN with custom config -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'marsa-blue': '#002366',
            'marsa-gold': '#FFD700',
            'marsa-teal': '#00C2CB',
            'marsa-navy': '#001A4D'
          },
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
            arabic: ['Tajawal', 'sans-serif']
          },
          animation: {
            'float': 'float 6s ease-in-out infinite',
            'wave': 'wave 12s linear infinite'
          },
          keyframes: {
            float: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-20px)' }
            },
            wave: {
              '0%': { transform: 'translateX(0)' },
              '100%': { transform: 'translateX(-50%)' }
            }
          }
        }
      }
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
  
  <!-- Animate.css for extra animations -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  
  <style>
    .maritime-pattern {
      background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 20c0-7.4-9-10-9-10s-3 2-3 10 9 10 9 10 3-2.6 3-10zM30 30c0-7.4-9-10-9-10s-3 2-3 10 9 10 9 10 3-2.6 3-10z' fill='%2300C2CB' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
    }
    
    .wave-mask {
      mask-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 1200 120' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' opacity='.25' fill='%23002166'/%3E%3Cpath d='M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z' opacity='.5' fill='%23002166'/%3E%3Cpath d='M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z' fill='%23002166'/%3E%3C/svg%3E");
      mask-size: 1200px 120px;
      mask-repeat: repeat-x;
      mask-position: bottom;
    }
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>

<body class="font-sans bg-gray-50 overflow-x-hidden">
  <!-- Animated Navigation Bar -->
  <nav class="fixed w-full z-50 bg-marsa-navy/90 backdrop-blur-md shadow-xl transition-all duration-300 hover:bg-marsa-navy">
    <div class="max-w-7xl mx-auto px-6 py-4">
      <div class="flex justify-between items-center">
        <div class="flex items-center space-x-3">
          <img src="{{ asset('assets/images/logo-marsa.png') }}" alt="Marsa Maroc" class="h-12 animate__animated animate__fadeInLeft">
          <span class="text-2xl font-bold text-white hidden md:block animate__animated animate__fadeIn">Gestion des Factures</span>
        </div>
        
        <div class="hidden md:flex items-center space-x-6">
          <a href="#" class="text-white hover:text-marsa-gold transition duration-300 font-medium">Accueil</a>
          <a href="#features" class="text-white hover:text-marsa-gold transition duration-300 font-medium">Fonctionnalités</a>
          <a href="#contact" class="text-white hover:text-marsa-gold transition duration-300 font-medium">Contact</a>
          
          <div class="flex space-x-4 ml-6">
            <a href="{{ route('login') }}" class="px-5 py-2 border-2 border-white rounded-full text-white hover:bg-white hover:text-marsa-blue transition duration-300 font-medium">
              Connexion
            </a>
            
          </div>
        </div>
        
        <!-- Mobile menu button -->
        <button class="md:hidden text-white focus:outline-none">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
  </nav>

  <!-- Hero Section with Animated Waves -->
  <section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
    <!-- Animated background elements -->
    <div class="absolute inset-0 z-0 maritime-pattern"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-marsa-blue/90 to-marsa-navy/90"></div>
    
    <!-- Floating container ships -->
    <div class="absolute left-10 top-1/4 animate-float">
      <svg class="w-24 h-24 text-white/20" fill="currentColor" viewBox="0 0 24 24">
        <path d="M23 18v2h-2v-2h2m-3-1v4h-4v-1h3v-3h1m4-6v5h-1v-4h-1v4h-1v-5h1v-1h1v1h1m-9.17-4H5a2 2 0 00-2 2v12h12v-2h2v4h4v-8h-4v2h-2v-4h-2v2h-2v-8h2.83L12 7.83 14.83 11zM3 5a2 2 0 012-2h8v2H5v6H3V5m12-2h6v2h-6V3z"/>
      </svg>
    </div>
    <div class="absolute right-20 top-1/3 animate-float" style="animation-delay: 2s">
      <svg class="w-32 h-32 text-white/15" fill="currentColor" viewBox="0 0 24 24">
        <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10m0-6V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14l4-4h10a2 2 0 002-2z"/>
      </svg>
    </div>
    
    <!-- Main hero content -->
    <div class="relative z-10 max-w-7xl mx-auto px-6 py-20 text-center">
      <div class="animate__animated animate__fadeInUp">
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-8 leading-tight">
          <span class="block">L'Excellence Portuaire</span>
          <span class="text-marsa-gold">Marocaine</span>
        </h1>
        
        <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto mb-12">
          Système intelligent de gestion des factures pour une logistique portuaire performante
        </p>
        
        <div class="flex flex-col sm:flex-row justify-center gap-6">
          <a href="{{ route('login') }}" class="px-8 py-4 bg-marsa-gold hover:bg-amber-500 text-marsa-blue font-bold rounded-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 animate__animated animate__pulse animate__infinite">
            Démarrer Maintenant
            <svg class="w-5 h-5 inline-block ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
          </a>
          <a href="#features" class="px-8 py-4 border-2 border-white text-white hover:bg-white/20 font-bold rounded-lg transition-all duration-300">
            Explorer les Fonctionnalités
          </a>
        </div>
      </div>
    </div>
    
    <!-- Animated wave divider -->
    <div class="absolute bottom-0 left-0 w-full h-40 wave-mask bg-marsa-teal/20 animate-wave"></div>
  </section>

  <!-- Features Section -->
  <section id="features" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-20">
        <h2 class="text-3xl md:text-4xl font-bold text-marsa-blue mb-6">
          <span class="border-b-4 border-marsa-gold pb-2">Solutions</span> Innovantes
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          Découvrez notre plateforme de gestion financière portuaire de nouvelle génération
        </p>
      </div>
      
      <div class="grid md:grid-cols-3 gap-12">
        <!-- Feature 1 -->
        <div class="bg-gradient-to-b from-blue-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 border border-gray-100 hover:border-marsa-teal/30 group">
          <div class="w-20 h-20 bg-marsa-blue rounded-xl flex items-center justify-center mb-6 mx-auto group-hover:rotate-6 transition duration-500">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-marsa-blue mb-4 text-center">Facturation Automatisée</h3>
          <p class="text-gray-600 text-center">
            Génération automatique des factures avec intégration des données portuaires en temps réel.
          </p>
        </div>
        
        <!-- Feature 2 -->
        <div class="bg-gradient-to-b from-blue-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 border border-gray-100 hover:border-marsa-teal/30 group">
          <div class="w-20 h-20 bg-marsa-blue rounded-xl flex items-center justify-center mb-6 mx-auto group-hover:rotate-6 transition duration-500">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-marsa-blue mb-4 text-center">Analytique Avancée</h3>
          <p class="text-gray-600 text-center">
            Tableaux de bord interactifs pour le suivi des performances financières et opérationnelles.
          </p>
        </div>
        
        <!-- Feature 3 -->
        <div class="bg-gradient-to-b from-blue-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 border border-gray-100 hover:border-marsa-teal/30 group">
          <div class="w-20 h-20 bg-marsa-blue rounded-xl flex items-center justify-center mb-6 mx-auto group-hover:rotate-6 transition duration-500">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-marsa-blue mb-4 text-center">Sécurité Maximale</h3>
          <p class="text-gray-600 text-center">
            Chiffrement de bout en bout et authentification multifactorielle pour une protection absolue.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="py-20 bg-marsa-blue text-white">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid md:grid-cols-4 gap-8 text-center">
        <div class="p-6">
          <div class="text-4xl font-bold text-marsa-gold mb-2">25+</div>
          <div class="text-lg">Ports Gérés</div>
        </div>
        <div class="p-6">
          <div class="text-4xl font-bold text-marsa-gold mb-2">10M+</div>
          <div class="text-lg">Factures Traitées</div>
        </div>
        <div class="p-6">
          <div class="text-4xl font-bold text-marsa-gold mb-2">99.9%</div>
          <div class="text-lg">Disponibilité</div>
        </div>
        <div class="p-6">
          <div class="text-4xl font-bold text-marsa-gold mb-2">24/7</div>
          <div class="text-lg">Support Technique</div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-20 bg-gradient-to-r from-marsa-teal to-marsa-blue text-white">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <h2 class="text-3xl md:text-4xl font-bold mb-8">Prêt à révolutionner votre gestion portuaire?</h2>
      <p class="text-xl mb-10 max-w-2xl mx-auto">
        Rejoignez les leaders du secteur maritime marocain avec notre solution complète.
      </p>
      <a href="{{ route('register') }}" class="inline-block px-10 py-4 bg-marsa-gold text-marsa-blue font-bold rounded-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
        Commencer l'Essai Gratuit
      </a>
    </div>
  </section>

  <!-- Footer -->
  <footer id="contact" class="bg-marsa-navy text-white pt-20 pb-10">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid md:grid-cols-4 gap-10">
        <div>
          <img src="{{ asset('assets/images/logo-marsa.png') }}" alt="Marsa Maroc" class="h-14 mb-6">
          <p class="text-blue-200">
            Leader de la gestion portuaire au Maroc, offrant des solutions logistiques innovantes depuis 2006.
          </p>
        </div>
        
        <div>
          <h4 class="text-lg font-bold mb-6 border-b border-marsa-teal pb-2">Navigation</h4>
          <ul class="space-y-3">
            <li><a href="#" class="text-blue-200 hover:text-white transition">Accueil</a></li>
            <li><a href="#features" class="text-blue-200 hover:text-white transition">Fonctionnalités</a></li>
            <li><a href="#contact" class="text-blue-200 hover:text-white transition">Contact</a></li>
          </ul>
        </div>
        
        <div>
          <h4 class="text-lg font-bold mb-6 border-b border-marsa-teal pb-2">Ressources</h4>
          <ul class="space-y-3">
            <li><a href="#" class="text-blue-200 hover:text-white transition">Documentation</a></li>
            <li><a href="#" class="text-blue-200 hover:text-white transition">Centre d'Aide</a></li>
            <li><a href="#" class="text-blue-200 hover:text-white transition">API</a></li>
          </ul>
        </div>
        
        <div>
          <h4 class="text-lg font-bold mb-6 border-b border-marsa-teal pb-2">Contact</h4>
          <address class="text-blue-200 not-italic">
            <div class="flex items-start mb-4">
              <svg class="w-5 h-5 mr-3 mt-1 text-marsa-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              <span>Quai Ouest, Port de Nador, Maroc</span>
            </div>
            <div class="flex items-center mb-4">
              <svg class="w-5 h-5 mr-3 text-marsa-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
              <span>contact@marsamaroc.ma</span>
            </div>
            <div class="flex items-center">
              <svg class="w-5 h-5 mr-3 text-marsa-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
              <span>+212 522 123 456</span>
            </div>
          </address>
        </div>
      </div>
      
      <div class="border-t border-marsa-blue mt-16 pt-8 text-center text-blue-300">
        <p>&copy; 2025 Marsa Maroc. Tous droits réservés.</p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script>
    // Simple mobile menu toggle
    document.querySelector('nav button').addEventListener('click', function() {
      const menu = document.createElement('div');
      menu.className = 'fixed inset-0 bg-marsa-navy/95 z-50 flex flex-col items-center justify-center space-y-8 p-6';
      menu.innerHTML = `
        <button class="absolute top-6 right-6 text-white text-4xl">&times;</button>
        <a href="#" class="text-2xl text-white hover:text-marsa-gold">Accueil</a>
        <a href="#features" class="text-2xl text-white hover:text-marsa-gold">Fonctionnalités</a>
        <a href="#contact" class="text-2xl text-white hover:text-marsa-gold">Contact</a>
        <div class="pt-8 border-t border-marsa-blue w-full max-w-xs text-center">
          <a href="{{ route('login') }}" class="block w-full py-3 px-6 mb-4 border-2 border-white rounded-full text-white">Connexion</a>
          
        </div>
      `;
      document.body.appendChild(menu);
      
      menu.querySelector('button').addEventListener('click', function() {
        document.body.removeChild(menu);
      });
    });
  </script>
</body>
</html>