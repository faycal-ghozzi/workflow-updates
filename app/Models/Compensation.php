<?php

namespace App\Models;

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

        //autorisation
        'valeur_decision', //autoriser à
        'autorisation',
        'disponible_autorisation',
        'date_exp_decision',

        //autorisation global
        'autorisation_global', //autoriser à
        'utilisation_global',
        'disponible_global',
        'date_global',

        //'nature_besoin',
        //'valeur_besoin',
        'val_compensation',

        'compensation_val',
        'classement_client',
        'impaye',
        //'recouvrement',
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
        //'engagement_client',
        'ligne_fournie',
        //'garantie',
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

        //gerant
        'interdit_gerant',
        'client_banque',
        'secteur_client',

        'justification',
        'status',
        'status_details',
        'user_id',

        //new attributes
        'name_secteur',
        'id_benef',
        'date_ouverture_new',
        'date_der_comp_new',
        'date_exp_decision_new',
        'date_global_new',
        'working_balance',
        'account_number',


        'status_final',
        'status',

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

    function Agence_function(){
        return $this->hasOne(Agence::class,'id','code_agence');
    }
}
