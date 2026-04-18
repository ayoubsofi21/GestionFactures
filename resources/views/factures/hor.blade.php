@extends('layouts.master')

@section('content')
<div class="container py-4">
    <h3 class="text-center fw-bold text-danger mb-4">Liste facture(s) hors délai :</h3>

    {{-- Tableau des factures dynamiques --}}
    <div class="table-responsive mb-4">
        <table class="table table-bordered text-center align-middle bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Reçue le</th>
                    <th>Date émission</th>
                    <th>Fournisseur</th>
                    <th>Facture</th>
                    <th>HT</th>
                    <th>TTC</th>
                    <th>Entité</th>
                    <th>Délai</th>
                    <th>Chemin Facture</th>
                </tr>
            </thead>
            <tbody>
                @foreach($factures as $facture)
                <tr>
                    <td>{{ $facture->date_reception_facture }}</td>
                    <td>{{ $facture->date_facture }}</td>
                    <td>{{ $facture->fournisseur->nom }}</td>
                    <td>{{ $facture->numero_facture }}</td>
                    <td>{{ number_format($facture->montant_ht, 2, ',', ' ') }}</td>
                    <td>{{ number_format($facture->montant_ttc, 2, ',', ' ') }}</td>
                    <td>{{ $facture->entite }}</td>
                    <td class="text-danger fw-bold">{{ (int)$facture->payment_delay }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $facture->scan_facture) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            Voir PDF
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <button class="btn btn-outline-secondary" onclick="location.reload()">
            🔄 Rafraîchir
        </button>

        <span class="text-muted small">
            Total : <strong>{{ count($factures) }}</strong> facture(s) hors délai
        </span>
    </div>
</div>
@endsection
