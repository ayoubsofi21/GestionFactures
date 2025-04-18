    @extends('layouts.master')

    @section('content')
    <!DOCTYPE html>
    <html lang="fr">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste factures hors délai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
        background-color: #f8f9fa;
        }
        .table th, .table td {
        vertical-align: middle;
        font-size: 0.9rem;
        }
        .container-box {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .btn-refresh {
        margin-top: 20px;
        }
    </style>
        <script>
            function openPDF(pdfUrl) {
              document.getElementById('pdfViewer').src = pdfUrl;
            }
          </script>
          {{-- rafraîchir la page --}}
          <script>
            document.addEventListener('DOMContentLoaded', function () {
                const refreshButton = document.querySelector('.btn-refresh');
                
                refreshButton.addEventListener('click', function () {
                    location.reload();  // This will reload the page
                });
            });
        </script>
        
          
    </head>
    <body>

    <div class="container mt-5 container-box">
    <h4 class="mb-4 text-center fw-bold">Liste facture(s) hors délai</h4>
    
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm align-middle text-center">
        <thead class="table-dark">
            <tr>
            <th>REÇUE LE</th>
            <th>DATE ÉMISSION</th>
            <th>FOURNISSEUR</th>
            <th>FACTURE</th>
            <th>HT</th>
            <th>TTC</th>
            <th>ENTITÉ</th>
            <th>DÉLAI</th>
            <th>CHEMIN FACTURE</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example row -->
            
                @foreach($factures as $facture)
                <tr>
                    <td>{{$facture->date_reception_facture}}</td>
                    <td>{{$facture->date_facture}}</td>
                    <td>{{$facture->fournisseur->nom}}</td>
                    <td>{{$facture->numero_facture}}</td>
                    <td>{{$facture->montant_ht}}</td>
                    <td>{{$facture->montant_ttc}}</td>
                    <td>{{$facture->entite}}</td>
                    <td>{{$facture->delai}}</td>
                    <td> 
                        {{-- <a href="{{ asset('storage/' . $facture->scan_facture) }}" 
                            target="_blank" 
                            class="btn btn-link">
                            {{ $facture->scan_facture }}
                         </a> --}}
                         <a href="{{ asset('storage/' . $facture->scan_facture) }}" target="_blank" class="btn btn-sm ">
                            📄 Voir
                        </a>
                         
                    </td>
                </tr>
                @endforeach
           
            <!-- You can duplicate or generate rows dynamically with a backend -->
        </tbody>
        </table>
    </div>

    <div class="text-end">
        <button type="button" class="btn btn-primary btn-refresh">🔄 Rafraîchir</button>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>

    @endsection