<?php

namespace App\Models\Compensation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DerniereCompensation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
    */
    protected $fillable = [
        'promesse',
        'valeur',
        'promesse_new',
        'id_compensation',
    ];
}
