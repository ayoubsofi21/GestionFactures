<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    // app/Models/Facture.php
    protected $fillable = ['numero', 'fournisseur', 'date', 'montant', 'description'];


}
