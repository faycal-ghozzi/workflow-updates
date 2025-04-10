<?php

namespace App\Models\Compensation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompensationDetails extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'value',
        'beneficiare',
        'code_compensation',
        'reference',
        'company',
        'type_trns',
        'devise',
        'application',
        'niveau',
        'version',
        'version_delete',
        'decision',
        'last_decision',
        'valider'
    ];

}
