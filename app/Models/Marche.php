<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Marche extends Model

{
    protected $table = 'marches';
    protected $fillable = [
        'marche_number',
        'object',
        'tutilier',
        'payment_delay'=>'payment_delay',
    ];
    
}