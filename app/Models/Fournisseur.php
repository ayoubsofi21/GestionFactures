<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Facture;
class Fournisseur extends Model
{
    protected $table = 'fournisseurs';

    protected $fillable = [
        'nom',
        'ice',
    ];

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }
}
