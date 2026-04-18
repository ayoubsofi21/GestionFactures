<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Facture;
class Marche extends Model

{
    protected $table = 'marches';
    protected $fillable = [
        'marche_number',
        'object',
        'tutilier',
        'payment_delay'=>'payment_delay',
    ];
    public function marches()
    {
        return $this->hasMany(Facture::class);
    }
}