<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEnregistrement;

class FactureAuthController extends Controller
{
    public function index(){
        //
    }
    /**
     * Show the form to create a new "Demande autorisation".
     */
    public function create(Request $request)
    {
        $autoenregistrements = AutoEnregistrement::all();
        return view('factureauto.create', compact('autoenregistrements'));
    }


    public function getFactureInfo($id)
{
    $facture = \App\Models\AutoEnregistrement::find($id);

    if (!$facture) {
        return response()->json(['error' => 'Facture non trouvée'], 404);
    }

    return response()->json([
        'id' => $facture->id,
        'scan' => asset('storage/' . $facture->scan_facture),
    ]);
}


    /**
     * Store a new "Demande autorisation" (Valider button).
     */
    public function store(Request $request)
    {
        // Example logic for storing data if needed
        // You can customize this part depending on your project logic
        return redirect()->back()->with('success', 'Facture autorisée avec succès.');
    }

    /**
     * Get facture info by ID (used for AJAX to auto-fill scan path and numero autorisation).
     */
//     public function show($id)
// {
//     $factures = Autoenregistrement::find($id);
//     if (!$factures) {
//         return view('factureauto.create', ['error' => 'Facture not found']);
//     }

//     return view('factureauto.create',compact('factures'));
// }

    /**
     * Delete a facture (Rejeter button).
     */
    // public function destroy(Request $request, $id = null)
    // {
    //     $facture = Autoenregistrement::find($request->facture_id);

    //     if ($facture) {
    //         // Just an example: mark as rejected, or delete, or log it
    //         // $facture->delete(); // Optional
    //     }

    //     return redirect()->back()->with('rejected', 'Facture rejetée avec succès.');
    // }
}
