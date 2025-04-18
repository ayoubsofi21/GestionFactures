<?php

namespace App\Http\Controllers;

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

        // Filter by Date Emission (you can customize this)
        if ($request->filled('recherche') && $request->recherche === 'date_emission') {
            $query->orderBy('date_facture', 'desc');
        }

        $factures = $query->get();

        return view('consultation', [
            'factures' => $factures,
            'filters' => $request->all()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
