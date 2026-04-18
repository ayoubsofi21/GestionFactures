<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;

class ConsultController extends Controller
{
    public function index(Request $request)
    {
        $query = Facture::with(['fournisseur', 'marche']);

        // Filter by Entité
        if ($request->filled('entite')) {
            $query->where('entite', $request->entite);
        }

        // Filter by search type and value
        if ($request->filled('recherche') && $request->filled('valeur')) {
            switch ($request->recherche) {
                case 'date_emission':
                    $query->whereDate('date_facture', $request->valeur);
                    break;
                // Add more cases here
            }
        }

        $factures = $query->get();

        // Split factures
        $factures_normales = $factures->filter(function ($facture) {
            return $facture->payment_delay <= 60;
        });

        $factures_hors_delai = $factures->filter(function ($facture) {
            return $facture->payment_delay > 60;
        });

        return view('consultation.create', [
            'factures' => $factures_normales,
            'factures_hors_delai' => $factures_hors_delai,
            'filters' => $request->all()
        ]);
        // return view('consultation.create', compact('factures'));
    }

    public function facturesHorsDelai()
    {
        $factures = Facture::with(['fournisseur', 'marche'])
            ->get()
            ->filter(function ($facture) {
                return $facture->payment_delay > 60;
            });

        return view('consultation.hors_delai', compact('factures'));
    }
}
