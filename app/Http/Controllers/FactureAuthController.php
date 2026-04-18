<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEnregistrement;
use App\Models\FactureAuto;
use App\Models\Facture;

class FactureAuthController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer les données passées depuis la redirection
        
        $factures = FactureAuto::all();
        // Passer les données à la vue
        return view('factureauto.index', compact('factures'));
    }


    /**
     * Show the form to create a new "Demande autorisation".
     */
    public function create(Request $request)
    {
        $autoenregistrements = AutoEnregistrement::all();
        return view('factureauto.create', compact('autoenregistrements'));
    }
   

    /**
     * Store a new "Demande autorisation" (Valider button).
     */
    public function store(Request $request)
{
    $request->validate([
        // 'facture_id' => 'required|integer|exists:autoenregistrements,id',
        'scan_facture' => 'required|string',
        'numero_autorisation' => 'required|integer',
        'date_creation' => 'required|date',
        'date_saisie' => 'required|string',
        'motif_rejet' => 'nullable|string',
    ]);

    $auto = \App\Models\AutoEnregistrement::findOrFail($request->facture_id);

    $facture = FactureAuto::create([
        'numero_facture' => $auto->numero_facture,
        'scan_facture' => $request->scan_facture,
        'numero_autorisation' => $request->numero_autorisation,
        'date_creation' => $request->date_creation,
        'date_saisie' => $request->date_saisie,
        'motif_rejet' => $request->motif_rejet,
    ]);


    return redirect()->back()->with('success', 'Facture enregistrée avec succès!');
}

    
    
    
    /**
     * Get facture info by ID (used for AJAX to auto-fill scan path and numero autorisation).
     */
//     public function show($id)
// {
//     $factures = AutoEnregistrement::find($id);
//     if (!$factures) {
//         return view('factureauto.create', ['error' => 'Facture not found']);
//     }

//     return view('factureauto.create',compact('factures'));
// }

    /**
     * Delete a facture (Rejeter button).
     */
    public function destroy(Request $request, $id)
{
    // You may or may not need the $id, since you're using a hidden input
    $factureId = $request->input('facture_id');
    $motifRejet = $request->input('motif_rejet');

    // Find the facture by ID
    $facture = FactureAuto::findOrFail($factureId);

    // Save rejection reason before deletion (optional)
    $facture->motif_rejet = $motifRejet;
    $facture->save();

    // OR if you're soft-deleting or flagging it as rejected:
    // $facture->statut = 'rejetée';
    // $facture->save();

    // Then delete if needed
    $facture->delete();

    return redirect()->back()->with('success', 'Facture rejetée avec motif : ' . $motifRejet);
}

}
