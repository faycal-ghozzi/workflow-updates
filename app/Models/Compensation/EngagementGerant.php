<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngagementGerant extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type_eng_gerant',
        'montant_eng_gerant',
        'date_eng_gerant',
        'id_compensation',
        'code_gerant',
        'nom_gerant',
        'client',
        'engagement',
        'devise',
        'encours_tnd',
        'classement'
    ];
}
