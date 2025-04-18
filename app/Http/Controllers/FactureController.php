<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Fournisseur;
use App\Models\Marche;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        $factures = Facture::all();
         return view('factures.index' ,compact('factures'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $factures = Facture::all();
        $fournisseurs = Fournisseur::all(); 
        $marches = Marche::all();
        return view('factures.create',compact('fournisseurs','marches'));
    }

public function store(Request $request)
{
     $validatedData = $request->validate([
        'date_reception_facture' => 'required|date',
        'date_facture' => 'nullable|date',
        'numero_facture' => 'required|string|max:255',
        'numero_autorisation_dfccb' => 'nullable|string|max:255',
        'scan_facture' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'fournisseur_id' => 'required|exists:fournisseurs,id',
        'montant_ht' => 'required|numeric|min:0',
        'taux_tva' => 'required|numeric|min:0|max:100',
        'montant_ttc' => 'required|numeric|min:0',
        'type_facture' => 'required|in:M,C,Ct,D',
        'numero_bl_attachement' => 'nullable|string|max:255',
        'numero_marche_bc_devis' => 'nullable|string|max:255',
        'objet_facture' => 'nullable|string|max:255',
        'entite' => 'nullable|string|max:50',
        'remarque' => 'nullable|string|max:1000',
    ]);

    // Handle file upload if exists
    if ($request->hasFile('scan_facture')) {
        $validatedData['scan_facture'] = $request->file('scan_facture')->store('factures', 'public');
    }

    // Save facture
    $facture = new Facture($validatedData);
    $facture->save();

    // Redirect with success message
    return redirect()->route('factures.index')->with('success', 'Facture enregistrée avec succès.');
}


    /**
     * Display the specified resource.
     */
    public function show(Facture $facture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facture $facture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facture $facture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facture $facture)
    {
        //
    }
}
