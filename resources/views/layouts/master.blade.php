<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Gestion des Factures')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- Optional CSS --}}
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .nav-bar {
            background-color: #f8f8f8;
            padding: 12px 20px;
            display: flex;
            gap: 30px;
            border-bottom: 2px solid #ccc;
            z-index: 1000;
            width: 100%;
            /* margin-left: 10px; */
            position:fixed;
        }
        .nav-bar a {
            font-weight: bold;
            text-decoration: none;
            margin-left: 30px;
        }
        .nav-bar a:nth-child(1) { color: darkblue; }
        .nav-bar a:nth-child(2) { color: black; }
        .nav-bar a:nth-child(3) { color: darkred; }
        .nav-bar a:nth-child(4) { color: darkgreen; }
        .nav-bar a:nth-child(5) { color: navy; }
        .nav-bar a:nth-child(6) { color: #003366; }
        .nav-bar a:nth-child(7) { color: goldenrod; }
        .nav-bar a:nth-child(8) { color: darkslategray; }
        .nav-bar a:nth-child(9) { color: darkred; }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            margin-top: 30px;
            padding: 10px;
            background: #f1f1f1;
            text-align: center;
            font-size: 14px;
}

        main {
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="nav-bar">
        <a href="/factures/create">Enregistrer Facture</a>
        <a href="/fournisseur">Fournisseur</a>
        <a href="#">Marché</a>
        <a href="#">Consultation</a>
        <a href="#">Autorisation</a>
        <a href="#">Instances</a>
        <a href="#">Liste_F_Aut</a>
        <a href="#">Factures Hors Délais</a>
        <a href="#">Quitter</a>
    </div>

    <main>
        @yield('content')
    </main>

    <div class="footer">
        &copy; {{ date('Y') }} - Application de gestion des factures
    </div>

</body>
</html>
