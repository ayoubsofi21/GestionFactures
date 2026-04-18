<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AutoEnregistrement;

class FactureAuto extends Model
{
    use HasFactory;
    protected $table = 'factureautorises';
    protected $fillable = [
        'numero_facture',
        'scan_facture',
        'numero_autorisation',
        'date_creation',
        'date_saisie',
        'motif_rejet'
    ];
    // public function autorisation()
    // {
    //     return $this->hasMany(AutoEnregistrement::class);
    // }
    public function marche(){
        return $this->belongsTo(Marche::class);
    }
}