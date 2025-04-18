<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Factures</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            background-color: #1e293b;
            color: white;
        }

        .sidebar .nav-link {
            color: #ffffff;
            font-weight: 500;
            margin-bottom: 2px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }

        .sidebar .nav-link i {
            width: 24px;
            text-align: center;
        }

        .main-content {
            padding: 2rem;
            min-height: calc(100vh - 120px);
        }

        .task-list .list-group-item {
            border-left: 0;
            border-right: 0;
            padding: 12px 15px;
        }

        .task-list .form-check-input {
            width: 18px;
            height: 18px;
            margin-top: 3px;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 1.5rem;
            text-align: center;
            border-top: 1px solid #dee2e6;
            width: 100%;
            position: fixed;
        }
        .footer .container {
            text-align: center;
            margin-right:20%;
        }

        .company-info {
            font-weight: 600;
            margin-top: 5px;
        }

        

        @media (min-width: 768px) {
            .sidebar {
                height: 100vh;
                position: fixed;
                top: 0;
                left: 0;
                width: 250px;
                padding-top: 20px;
            }

            .main-content {
                margin-left: 250px;
            }

            .footer {
                margin-left: 250px;
            }
        }

        @media (max-width: 767.98px) {
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }

            .main-content {
                margin-left: 0;
                padding: 1.5rem;
            }

            .footer {
                margin-left: 0;
            }
        }

        /* .nav-link {
        padding: 10px 20px;
        background-color: #333;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
        } */

        .nav-link.active {
        background-color: rgb(14, 17, 251); /* Change this to the color you want */
        }

    </style>
</head>
<body>
    <!-- Top Navbar (mobile only) -->
    <nav class="navbar navbar-dark bg-dark d-md-none">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="bi bi-receipt-cutoff me-2"></i>Factures
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMobile">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar collapse d-md-block d-flex" id="sidebarMobile">
        <div class="d-flex flex-column h-100">
            <div class="p-3">
                <a href="/" class="d-none d-md-flex align-items-center mb-3 text-white text-decoration-none">
                    <span class="fs-4 fw-bold">
                        <i class="bi bi-receipt-cutoff me-2"></i>Factures
                    </span>
                </a>
                <hr class="text-white d-none d-md-block">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="/factures/create" class="nav-link">
                            <i class="bi bi-file-earmark-plus me-2"></i>Enregistrer Facture
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/fournisseur/create" class="nav-link">
                            <i class="bi bi-people-fill me-2"></i>Fournisseur
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/marche/create" class="nav-link">
                            <i class="bi bi-briefcase-fill me-2"></i>Marché
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/consultation" class="nav-link">
                            <i class="bi bi-search me-2"></i>Consultation
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/autorisation/create" class="nav-link">
                            <i class="bi bi-check-circle me-2"></i>Autorisation
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/factureAuto/create" class="nav-link">
                            <i class="bi bi-diagram-3-fill me-2"></i>Instances
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/facturesx" class="nav-link">
                            <i class="bi bi-list-task me-2"></i>Liste_F_Aut
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/factures" class="nav-link">
                            <i class="bi bi-clock-history me-2"></i>Hors Délais
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <a href="#" class="nav-link text-warning" id="quit-button">
                            <i class="bi bi-box-arrow-right me-2"></i>Quitter
                        </a>
                    </li>
                </ul>
            </div>
           
                
            
        </div>
        
           
    </div>

    
        
    
    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">            
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div>&copy; {{ date('Y') }} - Application de gestion des factures</div>
            {{-- <div class="company-info">Marsa Maroc</div>
            <div class="company-info">WE LIFT YOUR GROWTH</div>
        
                 by
                <select >
                    <option value="">Show all</option>
                    <option value="">Ayoub Sofi</option>
                    <option value="">Fatin</option>
                    <option value="">Issam</option>
                </select>
             --}}
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
            // Mobile sidebar toggle
            const sidebarToggles = document.querySelectorAll('[data-bs-toggle="collapse"]');
            
            // Quit button confirmation
            const quitButton = document.getElementById('quit-button');
            if (quitButton) {
                quitButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm('Êtes-vous sûr de vouloir quitter l\'application ?')) {
                        // Here you would typically redirect or close the application
                        window.location.href = '/logout'; // Example redirect
                    }
                });
            }
            

            const items = document.querySelectorAll('.nav-link');

items.forEach(item => {
    item.addEventListener('click', () => {
        // Remove "active" from all items
        items.forEach(el => el.classList.remove('active'));
        // Add "active" to the clicked one
        item.classList.add('active');
    });
});


    </script>
</body>
</html>