<?php
//doesn't work marche in table very will 
namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Fournisseur;
use App\Models\Marche;
use Illuminate\Http\Request;
use App\Models\Consultation;
use Illuminate\Support\Facades\DB;
 use Carbon\Carbon;
class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $factures = Facture::all();
    //     return view('factures.index', compact('factures'));
    // }
    
    public function consultation()
    {
        $factures = Facture::all()->filter(function($facture) {
            return $facture->payment_delay <=60;
        });

        return view('consultation.create', compact('factures'));
    }
    //hors delay
    public function facturesHorsDelai()
    {
        $factures = Facture::all()->filter(function($facture) {
            return $facture->payment_delay >60;
        });

        return view('factures.index', compact('factures'));
    }
    
    public function checkAutorisation(Request $request)
    {
        $numero = $request->query('numero_facture');
        
        $exists = DB::table('factureautorises')
            ->where('numero_facture', $numero)
            ->exists();

        return response()->json(['autorisee' => $exists]);
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
            'entite' => 'nullable|string|max:50',
            'remarque' => 'nullable|string|max:1000',
        ]);
    
        // Handle file upload if exists
        if ($request->hasFile('scan_facture')) {
            $validatedData['scan_facture'] = $request->file('scan_facture')->store('factures', 'public');
        }    
        $facture = Facture::create($validatedData);
    
        return redirect()->route('consultation')->with('success', 'Facture enregistrée avec succès.');
    }
        public function validerFacture($id)
    {
        // Récupérer la facture via son ID
        $facture = Facture::findOrFail($id);

        // Vérifier si la facture est autorisée
        if ($facture->autorisee) {
            // Récupérer les informations liées à la facture autorisée
            $factureAuto = FactureAuto::where('numero_facture', $facture->numero_facture)->first();
            
            // Récupérer les informations du marché associé à la facture
            $marche = Marche::where('marche_number', $facture->numero_marche_bc_devis)->first();

            // Préparer les données à envoyer à la vue
            $datas = [
                'numero_facture' => $facture->numero_facture,
                'scan_facture' => $factureAuto->scan_facture,
                'numero_autorisation' => $factureAuto->numero_autorisation,
                'date_saisie' => $factureAuto->date_saisie,
                'date_reception' => $factureAuto->date_creation,
                'tutilier' => $marche ? $marche->tutilier : null,
                'motif' => $factureAuto->motif_rejet,
                'montant_ht' => $facture->montant_ht,
                'montant_ttc' => $facture->montant_ttc,
            ];

            return redirect()->route('factureauto.index', ['datas' => $datas]);

        } else {
            // Si la facture n'est pas autorisée
            return redirect()->back()->with('error', 'La facture n\'est pas autorisée.');
        }
}


}
