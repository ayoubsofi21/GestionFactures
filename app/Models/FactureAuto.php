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
        'facture_num',
        'scan_facture',
        'autoristaion_num',
        'motif'
    ];
    public function autorisation()
    {
        return $this->hasMany(AutoEnregistrement::class);
    }
}