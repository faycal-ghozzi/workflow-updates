<?php

namespace App\Models\Compensation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncoursEffet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
    */
    protected $fillable = [
        'cfu',
        'num_effet',
        'nom_tire',
        'rib_tire',
        'montant',
        'date_echenace',
        'date_remise',
        'status',
        'id_compensation',
    ];
}
