<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEnregistrement;
use Illuminate\Support\Carbon;

class AutoEnregistrementController extends Controller
{
    public function create() {
        return view('autorisation.create');
    }
    public function store(Request $request)
{
    $request->validate([
        'numero_facture' => 'required|string|max:255',
        'scan_facture' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    // Gérer l'upload du fichier
    if ($request->hasFile('scan_facture')) {
        $file = $request->file('scan_facture');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('factures', $filename, 'public');
    } else {
        return back()->with('error', 'Fichier manquant');
    }

    // Création de l'enregistrement
    AutoEnregistrement::create([
        'numero_facture' => $request->input('numero_facture'),
        'scan_facture' => $path, // Assure-toi que cette colonne accepte une chaîne (string)
        'date_creation' => Carbon::now()->format('Y-m-d'),
    ]);

    return redirect()->back()->with('success', 'Facture enregistrée avec succès');

}
    // Afficher le formulaire d’autorisation
    public function edit($id)
    {
        
    }

    // Mise à jour de l’autorisation
    public function update(Request $request, $id)
    {
        
    }

    // Les autres méthodes peuvent rester vides si tu ne les utilises pas
    
    public function show($id) {}
    public function destroy($id) {}
}
