<?php
// app/Models/Facture.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fournisseur;
use App\Models\Marche;
use App\Models\Consultation;
use Carbon\Carbon;

class Facture extends Model
{
    use HasFactory;

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
        'payment_delay',
        'autorisee',
        'numero_autorisation',
        // 'is_hors_delai',
    ];
    public function getPaymentDelayAttribute()
    {
        return Carbon::parse($this->date_reception_facture)->diffInDays(Carbon::now());
    }
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
    public function marche()
    {
        return $this->belongsTo(Marche::class);
    }
    public function consultation()
        {
            return $this->hasOne(Consultation::class);
        }
    // In Facture.php model
}
