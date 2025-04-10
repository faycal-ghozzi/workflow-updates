<?php

namespace App\Models\Avis;

use App\Models\Compensation\CompensationDetails;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvisCompensationAgence extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
    */
    protected $fillable = [
        'id_avis',
        'compensation_detail_id',

        'decision',
        'name_detail',
        'montant_detail',
        'beneficiare_detail',
        'compensation_id',
        'reference',
        'company',
        'type_trns',
        'devise',
        'application',
        'niveau',
        'version',
        'version_delete',
        'decision_preced',
        'motif'
    ];

    function avisCompChef(){
        return $this->belongsTo(Avis::class,'id_avis','id');
    }

    function compensationDetailAvisChef(){
        return $this->belongsTo(CompensationDetails::class,'compensation_detail_id','id');
    }
}
