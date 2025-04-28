<?php

namespace App\Models\Compensation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpayeBesoin extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
    */
    protected $fillable = [
        'nature_besoin',
        'valeur_besoin',
        'echeance_besoin',
        'date_besoin',
        'id_compensation',
        'ref',
        'devise',
        'mantant_tnd'
    ];
}
