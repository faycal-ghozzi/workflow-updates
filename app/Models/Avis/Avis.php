<?php

namespace App\Models\Avis;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
    */
    protected $fillable = [
        'text_avis',
        'user_id',
        'compensation_id',
        'date_input',
        'role_user'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_input' => 'date',
    ];

    function user_func(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    function avis_exploitation_compensation(){
        return $this->hasMany(AvisCompensationExpl::class,'id_avis','id')->orderBy('created_at');
    }

    function avis_risque_compensation(){
        return $this->hasMany(AvisCompensationRisque::class,'id_avis','id')->orderBy('created_at');
    }

    function avis_chef_compensation(){
        return $this->hasMany(AvisCompensationAgence::class,'id_avis','id')->orderBy('created_at');
    }
}
