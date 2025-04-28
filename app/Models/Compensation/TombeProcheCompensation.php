<?php

namespace App\Models\Compensation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TombeProcheCompensation extends Model
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
        'date_ech',
        'date_proche',
        'category',
        'id_compensation',
    ];
}
