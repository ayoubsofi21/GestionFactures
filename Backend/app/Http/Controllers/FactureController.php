<?php
// app/Http/Controllers/FactureController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;

class FactureController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference' => 'required|unique:factures',
            'fournisseur' => 'required|string',
            'date_facture' => 'required|date',
            'montant' => 'required|numeric',
            'description' => 'nullable|string'
        ]);

        $facture = Facture::create($validated);
        return response()->json(['success' => true, 'data' => $facture]);
    }
}

