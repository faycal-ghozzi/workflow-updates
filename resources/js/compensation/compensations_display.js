import Swal from 'sweetalert2';
import $ from 'jquery';

$(document).ready(function () {
    // Désactiver les boutons radio spécifiques
    const toDisable = [
        'interdit_chq_ben_oui', 'interdit_chq_ben_non',
        'respect_promet_oui', 'respect_promet_non',
        'liste_finance_rapport_reserve_oui', 'liste_finance_rapport_reserve_non',
        'liste_finance_rapport_oui', 'liste_finance_rapport_non',
        'liste_finance_final_oui', 'liste_finance_final_non',
        'depassement_oui', 'depassement_non',
        'montant_non_paye_oui', 'montant_non_paye_non',
        'interdit_chq_client_oui', 'interdit_chq_client_non',
    ];

    toDisable.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.disabled = true;
    });

    // Format number with spaces every 3 digits
    function numStr(a) {
        return Number(a).toLocaleString('fr-FR');
    }

    // Sanitize a formatted string to extract a number
    function sanitizeNumber(str) {
        if (typeof str !== 'string') str = String(str);
        const cleaned = str.replace(/[^\d.-]/g, '');
        return parseFloat(cleaned);
    }

    // Remplir solde après calcul
    const solde = sanitizeNumber(document.getElementById('solde_actuel')?.value || 0);
    const total = sanitizeNumber(document.getElementById('total_comp')?.value || 0);
    const apres = Math.trunc(solde - total);
    const soldeApr = document.getElementById('soldeApr');
    if (soldeApr) soldeApr.value = numStr(apres);

    // Formater les champs numériques
    const champs = [
        'total_comp', 'solde_actuel', 'encaissement_effet_etude', 'encaissement_effet',
        'chiffre_ans_preced', 'chiffre_ans_encours', 'nb_transaction',
        'chiffre_n', 'resultat_brut', 'resultat_n', 'montant_der_comp', 'versement'
    ];

    champs.forEach(id => {
        const el = document.getElementById(id);
        if (el && el.value !== '') {
            const value = sanitizeNumber(el.value);
            if (!isNaN(value)) {
                el.value = numStr(Math.trunc(value));
            }
        }
    });

    // Calcule total débit = compensation + impayé
    const totalComp = sanitizeNumber(document.getElementById('total_comp_comp')?.value || 0);
    const impaye = sanitizeNumber(document.getElementById('TOTAL_IMPAYE')?.value || 0);
    const totalDebit = document.getElementById('total_debit');
    if (totalDebit) totalDebit.value = numStr(Math.trunc(totalComp + impaye));

    // Formate aussi total_comp_edit si existant
    const totalCompEdit = document.getElementById('total_comp_edit');
    if (totalCompEdit) {
        const val = sanitizeNumber(document.getElementById('total_comp')?.value || 0);
        totalCompEdit.value = numStr(Math.trunc(val));
    }
});

// SweetAlert2 Toasts
$(function () {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $('.swalDefaultSuccess').click(function () {
        Toast.fire({
            icon: 'success',
            title: 'Compensation Acceptée'
        });
    });

    $('.swalDefaultError').click(function () {
        Toast.fire({
            icon: 'error',
            title: 'Compensation Refusée'
        });
    });
});
