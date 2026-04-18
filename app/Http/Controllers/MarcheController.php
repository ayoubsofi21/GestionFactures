<?php

namespace App\Http\Controllers;

use App\Models\Marche;
use Illuminate\Http\Request;
class MarcheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marchefactures = Marche::all();
        return view('factures.create', compact('marchefactures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marches = Marche::all();
        return view('marche.create', compact('marches'));
    }
    
    

    public function store(Request $request)
    {
        $validate = $request->validate([
            'marche_number' => 'required|string|max:255',
            'object' => 'required|string|max:1000',
            'tutilier' => 'required|string|max:255',
            'payment_delay' => 'required|integer',
        ]);

        Marche::create($validate);

        return redirect()->route('marche.create')->with('success', 'Marché ajouté avec succès.');
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