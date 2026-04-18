<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
    
}
