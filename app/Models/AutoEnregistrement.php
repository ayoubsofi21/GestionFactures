<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FactureAuto;
class AutoEnregistrement extends Model
{
    use HasFactory;
    protected $table = 'authorisations';
   protected $fillable = ['numero_facture', 'scan_facture'];
    // public function authfacture(){
    //     return $this->belongsTo(FactureAuto::class);
    // }

}