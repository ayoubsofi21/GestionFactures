<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Fournisseur;

class Facture extends Model
{
    use HasFactory;
    protected $table = 'factures';
    protected $fillable = [
        'date_reception_facture',
        'date_facture',
        'numero_facture',
        'numero_autorisation_dfccb',
        'scan_facture',
        'fournisseur_id',
        'montant_ht',
        'taux_tva',
        'montant_ttc',
        'type_facture',
        'numero_bl_attachement',
        'numero_marche_bc_devis',
        'objet_facture',
        'entite',
        'remarque',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }    
}
