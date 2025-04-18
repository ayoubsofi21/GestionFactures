@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">📄 Consultation des factures</h2>
        <a href="#" class="btn btn-sm btn-secondary">← Accueil</a>
    </div>

    {{-- Filter Form --}}
    <form method="GET" action="#" class="row mb-4">
        <div class="col-md-3">
            <label for="entite" class="font-weight-bold">Entité</label>
            <select name="entite" id="entite" class="form-control">
                <option value="">Sélectionner une entité</option>
                <option value="DE" {{ ($filters['entite'] ?? '') == 'DE' ? 'selected' : '' }}>DE</option>
                <option value="DOM" {{ ($filters['entite'] ?? '') == 'DOM' ? 'selected' : '' }}>DOM</option>
                <option value="DSI" {{ ($filters['entite'] ?? '') == 'DSI' ? 'selected' : '' }}>DSI</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="recherche" class="font-weight-bold">Recherche par</label>
            <select name="recherche" id="recherche" class="form-control">
                <option value="date_emission" {{ ($filters['recherche'] ?? '') == 'date_facture' ? 'selected' : '' }}>Date Emission</option>
            </select>
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary btn-block">
                🔍 Rechercher
            </button>
        </div>
    </form>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm bg-white">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Reçue le</th>
                    <th>Date Emission</th>
                    <th>Fournisseur</th>
                    <th>Facture</th>
                    <th>HT</th>
                    <th>TTC</th>
                    <th>Entité</th>
                    <th>Délai</th>
                    <th>Facture (PDF)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($factures as $facture)
                    <tr>
                        <td>{{ $facture->date_reception_facture }}</td>
                        <td>{{ $facture->date_facture }}</td>
                        <td>{{ $facture->fournisseur->nom }}</td>
                        <td>{{ $facture->numero_facture }}</td>
                        <td>{{ number_format($facture->montant_ht, 2) }} DH</td>
                        <td>{{ number_format($facture->montant_ttc, 2) }} DH</td>
                        <td>{{ $facture->entite }}</td>
                        <td>{{ $facture->marche->payment_delay ?? 'N/A' }}</td>
                        <td class="text-center">
                            @if($facture->scan_facture)
                                <a href="{{ asset('storage/' . $facture->scan_facture) }}" target="_blank" class="btn btn-sm mr-2">
                                    📄 Voir
                                </a>
                                
                            @else
                                <span class="text-muted">Aucun</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">Aucune facture trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Bottom buttons --}}
    <div class="d-flex justify-content-between mt-4">
        <a href="#" class="btn btn-secondary">← Retour</a>
        <div>
            <a href="" class="btn btn-outline-primary mr-2">🔄 Rafraîchir</a>
            <a href="#" class="btn btn-success">⬇ Exporter en Excel</a>
        </div>
    </div>
</div>
@endsection
