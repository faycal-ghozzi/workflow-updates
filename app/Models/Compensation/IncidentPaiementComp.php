<?php

namespace App\Models\Compensation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentPaiementComp extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
    */
    protected $fillable = [
        'ref',
        'num_chq',
        'code_presentation',
        'montant',
        'currency',
        'date_emission',
        'rib_benef',
        'nom_benef',
        'motif_rejet',
        'id_compensation',
        'date_regule',
        'stade'
    ];
}
