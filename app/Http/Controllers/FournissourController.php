<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;

class FournissourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view('fournisseur', compact('fournisseurs'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $fournisseurs = Fournisseur::all();
        return view('fournisseur',compact('fournisseurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->input('action') === 'ajouter') {
            // Validation
            $request->validate([
                'nom' => 'required|string|max:255',
                'ice' => 'required|string|max:255|unique:fournisseurs',
            ]);
    
            // Store new fournisseur
            Fournisseur::create([
                'nom' => $request->input('nom'),
                'ice' => $request->input('ice'),
            ]);
    
            return redirect()->route('fournisseur.create')->with('success', 'Fournisseur ajouté avec succès.');
        }
    
        if ($request->input('action') === 'rechercher') {
            $query = Fournisseur::query();
    
            if ($request->filled('nom')) {
                $query->where('nom', 'like', '%' . $request->nom . '%');
            }
    
            if ($request->filled('ice')) {
                $query->where('ice', 'like', '%' . $request->ice . '%');
            }
    
            $fournisseurs = $query->get();
    
            return view('fournisseur', compact('fournisseurs'));
        }
    
        return redirect()->route('fournisseur.index');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
