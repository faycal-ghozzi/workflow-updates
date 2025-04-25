<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacementCompensation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
    */
    protected $fillable = [
        'reference',
        'nature',
        'montant',
        'devise',
        'du',
        'au',
        'taux',
        'basetmm',
        'marge',
        'id_compensation',
    ];
}
