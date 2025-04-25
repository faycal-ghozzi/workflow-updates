<?php

namespace App\Models\Compensation;

use App\Models\Avis\Avis;
use App\Models\Agence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Compensation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code_agence',
        'date_compensation',
        'beneficiare',
        'code_client',
        'nom_client',
        'date_ouverture',
        'agent_societe',
        'domaine_societe',
        'solde_actuel',
        'solde_compensation',
        'devise_compensation',
        'valeur_decision',
        'autorisation',
        'disponible_autorisation',
        'date_exp_decision',
        'autorisation_global',
        'utilisation_global',
        'disponible_global',
        'date_global',
        'val_compensation',
        'compensation_val',
        'classement_client',
        'impaye',
        'cheque_encours',
        'cheque_encours_devise',
        'cheque_encours_tire',
        'cheque_encours_date',
        'escompte_effet',
        'encaissement_effet',
        'encaissement_effet_etude',
        'versement',
        'note_couverture',
        'solde_apres',
        'chiffre_ans_preced',
        'chiffre_ans_encours',
        'ligne_fournie',
        'delai_parvenir',
        'chiffre_n',
        'nb_transaction',
        'resultat_brut',
        'resultat_n',
        'interdit_chq_client',
        'interdit_chq_client_date',
        'interdit_chq_client_nombre',
        'montant_non_paye',
        'depassement',
        'liste_finance_final',
        'annee_etat_financier',
        'type_etat_financier',
        'liste_finance_rapport',
        'liste_finance_rapport_reserve',
        'anneecommissaire',
        'nature_tombe',
        'montant_tombe',
        'echeance_tombe',
        'devise_tombe',
        'date_der_comp',
        'montant_der_comp',
        'promesse_der_comp_update',
        'decision_der_comp',
        'respect_promet',
        'montant_promesse',
        'note_der_comp_update',
        'interdit_chq_ben',
        'code_autre_sc',
        'nom_autre_sc',
        'activite_autre_sc',
        'situation_banque_ben',
        'situation_agent_benf',
        'interdit_gerant',
        'client_banque',
        'secteur_client',
        'justification',
        'status',
        'status_details',
        'user_id',
        'name_secteur',
        'id_benef',
        'date_ouverture_new',
        'date_der_comp_new',
        'date_exp_decision_new',
        'date_global_new',
        'working_balance',
        'account_number',
        'status_final',
        'test',
        'email_client'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_compensation' => 'date',
        'date_exp_decision' => 'date',
        'date_der_comp' => 'date',
        'date_ouverture' => 'date',
        'date_global' => 'date',
        'cheque_encours_date' => 'date',
    ];

    function compensation_status(){
        return $this->hasMany(CompensationStatus::class,'id','status');
    }

    function compensation_status_d(){
        return $this->hasMany(CompensationStatusDetail::class,'compensation_id','id')->orderBy('created_at');
    }

    function detail_comp(){
        return $this->hasMany(CompensationDetails::class,'code_compensation','id');
    }

    function justification_comp(){
        return $this->hasMany(CompensationJustification::class,'id_compensation','id');
    }

    // function engagement_gerant(){
    //     return $this->hasMany(Engagement_gerant::class,'id_compensation','id');
    // }

    // function impaye_besoin(){
    //     return $this->hasMany(Impaye_besoin::class,'id_compensation','id');
    // }

    function impaye_client(){
        return $this->hasMany(ImpayeClient::class,'id_compensation','id');
    }

    function avis_comp(){
        return $this->hasMany(Avis::class,'compensation_id','id')->orderBy('created_at');
    }

    function Agence_function(){
        return $this->hasOne(Agence::class,'id','code_agence');
    }

    // function placement_compensation(){
    //     return $this->hasMany(PlacementCompensation::class,'id_compensation','id');
    // }

    // function credit_compensation(){
    //     return $this->hasMany(CreditCompensation::class,'id_compensation','id');
    // }

    // function encours_compensation(){
    //     return $this->hasMany(EncoursCompensation::class,'id_compensation','id');
    // }

    // function tombe_compensation(){
    //     return $this->hasMany(TombeProcheCompensation::class,'id_compensation','id');
    // }

    // function autre_compte(){
    //     return $this->hasMany(AutreCompte::class,'id_compensation','id');
    // }

    // function derniere_compensation_justif(){
    //     return $this->hasMany(DerniereCompensation::class,'id_compensation','id');
    // }

    // function impaye_leasing_compensation(){
    //     return $this->hasMany(ImpayeLeasingCompensation::class,'id_compensation','id');
    // }

    // function incident_paiement_compensation(){
    //     return $this->hasMany(IncidentPaiementComp::class,'id_compensation','id');
    // }

    // function encous_effet_compensation(){SS
    //     return $this->hasMany(EncoursEffet::class,'id_compensation','id');
    // }

    // Maybe add these

    // public function details() {
    //     return $this->hasMany(CompensationDetails::class);
    // }
    
    // public function justifications() {
    //     return $this->hasMany(CompensationJustification::class);
    // }
    
    // public function impayeClients() {
    //     return $this->hasMany(ImpayeClient::class);
    // }
    
    // public function status() {
    //     return $this->hasOne(CompensationStatus::class)->latestOfMany();
    // }
    
    // public function files() {
    //     return $this->hasMany(CompensationFile::class);
    // }
}
