@extends('layout.app')

@section('title', 'Consultation Compensation')

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Consultation Compensation</h4>
        </div>
        <div class="card-body">
            <div class="content-wrapper">

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </section>
        
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                @if (Auth::user()->hasRole('Charge'))
                                @if(($view_comp->status == 1))
                                    <button class="btn btn btn-info" id="check-email" data-toggle="modal" data-target="#modal_decision_charge_{{$view_comp->id}}" {{ Auth::user()->hasRole('Charge') ? 'disabled' : ''}}>{{ __('Avis') }}</button>
                                @endif
                                @endif
        
                                @if (Auth::user()->hasRole('Chef_agence'))
                                @if(($view_comp->status == 4)||($view_comp->status == 5))
                                <button class="btn btn btn-info" data-toggle="modal" data-target="#modal_decision_chef_{{$view_comp->id}}">{{ __('Avis') }}</button>
                                @endif
                                @if($view_comp->status == 12)
                                <button class="btn btn btn-warning" data-toggle="modal" data-target="#modal_arbitrage_chef_{{$view_comp->id}}">{{ __('Arbitrage') }}</button>
                                @endif
                                @endif
        
                                @if ((Auth::user()->hasRole('Exploitation_particulier'))||(Auth::user()->hasRole('Exploitation_corporate')))
                                    @if(($view_comp->status == 6)||($view_comp->status == 7))
                                        <button class="btn btn btn-info" data-toggle="modal" data-target="#modal_decision_exp_particulier_{{$view_comp->id}}">{{ __('Avis') }}</button>
                                    @endif
                                @endif
        
                                @if (Auth::user()->hasRole('Exploitation_décideur'))
                                    @if(($view_comp->status == 8)||($view_comp->status == 9)||($view_comp->status ==10)||($view_comp->status == 11)||($view_comp->status ==20)||($view_comp->status == 21))
                                        <button class="btn btn btn-info" data-toggle="modal" data-target="#modal_decision_exp_decideur_{{$view_comp->id}}">{{ __('Avis') }}</button>
        
                                    @endif
                                    @if($view_comp->status == 14)
                                    <button class="btn btn btn-warning" data-toggle="modal" data-target="#modal_arbitrage_ex_{{$view_comp->id}}">{{ __('Arbitrage') }}</button>
                                    @endif
                                @endif
        
                                @if (Auth::user()->hasRole('Risque'))
                                @if(($view_comp->status == 13)||($view_comp->status == 22))
                                    <button class="btn btn btn-info" data-toggle="modal" data-target="#modal_decision_exp_risque_{{$view_comp->id}}">{{ __('Avis') }}</button>
                                    @endif
        
                                    @if(($view_comp->status == 22))
                                    <button class="btn btn btn-warning" data-toggle="modal" data-target="#modal_arbitrage_risque_{{$view_comp->id}}">{{ __('Arbitrage') }}</button>
                                    @endif
                                @endif
        
                                @if (Auth::user()->hasRole('PDG')||Auth::user()->hasRole('DGA'))
                                @if(($view_comp->status == 15)||($view_comp->status == 25)||($view_comp->status == 24))
                                    <button class="btn btn btn-success" data-toggle="modal" data-target="#modal_accept_pdg_{{$view_comp->id}}">{{ __('Accord') }}</button>
                                    <button class="btn btn btn-danger" data-toggle="modal" data-target="#modal_refuse_pdg_{{$view_comp->id}}">{{ __('Rejet') }}</button>
                                    @endif
                                @endif
                                <button class="btn btn btn-default" data-toggle="modal" data-target="#modal_list_avis_{{$view_comp->id}}">{{ __('Consulter les avis') }}</button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default"><i class="fa fa-print"></i>SED Client</button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item btn" href="{{ url('/download/'.$view_comp->id) }}">{{ __('Engagement sur le SED') }}</a>
                                        <a class="dropdown-item btn" href="{{ url('/downloadRisque/'.$view_comp->id) }}">{{ __('Risque sur le SED') }}</a>
                                        <a class="dropdown-item btn" href="{{ url('/downloadGarantie/'.$view_comp->id) }}">{{ __('Garantie') }}</a>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default"><i class="fa fa-print"></i> {{ __('SED gérant') }}</button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item btn" href="{{ url('/downloadClassementGerant/'.$view_comp->id) }}">{{ __('Classement') }}</a>
                                        <a class="dropdown-item btn" href="{{ url('/downloadCreditParticulierGerant/'.$view_comp->id) }}">{{ __('Crédit au particulier') }}</a>
                                        <a class="dropdown-item btn" href="{{ url('/downloadChqImpayeGerant/'.$view_comp->id) }}">{{ __('Chèque impayé') }}</a>
        
                                    </div>
                                </div>
        
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default"><i class="fa fa-print"></i> {{ __('Autre Société') }}</button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item btn" href="{{ url('/downloadBeneficiareSed/'.$view_comp->id) }}">{{ __('Engagement sur le SED') }}</a>
                                        <a class="dropdown-item btn" href="{{ url('/downloadBeneficiareClassement/'.$view_comp->id) }}">{{ __('Classement') }}</a>
                                    </div>
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
        
                        <br>
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">{{ __('Inputter') }} : {{ $view_comp->user_id}} {{ __('à Agence') }} : {{ $view_comp->Agence_function->designation}} </h3>
                            <h3 class="card-title float-right">{{ __('Date') }} : {{ $view_comp->date_compensation->format('d-m-Y') }}</h3>
                            </div>
                            <div class="card-body">
                                @if ($view_comp->account_number !== null)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>{{__('Code Client')}} :</label>
                                                {{-- TODO : Verify view_comp --}}
                                                <input type="text" id="code_client" class="form-control " value="{{ $view_comp->code_client }}" readonly/>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>{{__('Numéro du compte')}} :</label>
                                                <input type="text" class="form-control " value="{{ $view_comp->account_number }}" readonly/>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>{{__('Client')}} :</label>
                                                <input type="text" class="form-control" value="{{ $view_comp->nom_client }}" readonly/>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>{{__('Secteur')}} :</label>
                                                <input type="text" class="form-control" value="{{ $view_comp->name_secteur }}" readonly/>
        
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>{{ __('Date d\'ouverture du compte') }} :</label>
                                                @if ($view_comp->date_ouverture == null)
                                                <input type="text" class="form-control" value="{{ $view_comp->date_ouverture_new }}" readonly/>
                                                @else
                                                <input type="text" class="form-control" value="{{ $view_comp->date_ouverture->format('d-m-Y') }}" readonly/>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>{{ __('Classement du client chez la banque')}} :</label>
                                                <input type="text" class="form-control" value="{{ $view_comp->classement_client}}" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>{{__('Code Client')}} :</label>
                                                <input type="text" id="code_client" class="form-control " value="{{ $view_comp->code_client }}" readonly/>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>{{__('Client')}} :</label>
                                                <input type="text" class="form-control" value="{{ $view_comp->nom_client }}" readonly/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{__('Secteur')}} :</label>
                                                <input type="text" class="form-control" value="{{ $view_comp->name_secteur }}" readonly/>
        
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>{{ __('Date d\'ouverture du compte') }} :</label>
                                                @if ($view_comp->date_ouverture == null)
                                                <input type="text" class="form-control" value="{{ $view_comp->date_ouverture_new }}" readonly/>
                                                @else
                                                <input type="text" class="form-control" value="{{ $view_comp->date_ouverture->format('d-m-Y') }}" readonly/>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{ __('Classement du client chez la banque')}} :</label>
                                                <input type="text" class="form-control" value="{{ $view_comp->classement_client}}" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ __('Activité du société') }} :</label>
                                            <input type="text" class="form-control" value="{{ $view_comp->domaine_societe}}" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ __('Identifiant Bénéficiaire Effectif') }} :</label>
                                            <input type="text" class="form-control" value="{{ $view_comp->id_benef}}" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ __('Bénéficiaire Effectif') }} :</label>
                                            <input type="text" class="form-control" value="{{ $view_comp->beneficiare}}" readonly/>
                                        </div>
                                    </div>
        
                                </div>
                                <br>
        
                                @if ($view_comp->agent_societe !== null)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Gérant du société') }} :</label>
                                            <input type="text" class="form-control" value="{{ $view_comp->agent_societe}}" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Est-ce que le gérant est un client de la banque ?') }} :</label>
                                            <div class="form-group">
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="client_banque" id="client_banque_gerant_oui" value="oui" @if($view_comp->client_banque =='oui') checked @endif>
                                                    <label class="form-check-label radio-inline">{{ __('Oui') }}</label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="client_banque" id="client_banque_gerant_non" value="non" @if($view_comp->client_banque =='non') checked @endif>
                                                    <label class="form-check-label">{{ __('Non') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                @endif
        
                                @if(count($view_comp->engagement_gerant)>0)
                                <div class="row" >
                                    <div class="col-12">
                                        <!-- radio -->
                                        <h5 class="card-description text-info">
                                            --- {{ __('Engagement du gérant avec la banque') }} ---
                                        </h5>
                                        <hr>
                                        <div class="form-group">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <th>{{ __('Code') }}</th>
                                                        <th>{{ __('Nom') }}</th>
                                                        <th>{{ __('Client de la banque') }}</th>
                                                        <th>{{ __('Classement') }}</th>
                                                        <th>{{ __('Engagement') }}</th>
                                                        <th>{{ __('Libelle') }}</th>
                                                        <th>{{ __('Date d\'echeance') }}</th>
                                                        <th>{{ __('Encours') }}</th>
                                                        <th>{{ __('Devise') }}</th>
                                                        <th>{{ __('Encours en TND') }}</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($view_comp->engagement_gerant as $imp)
                                                                <tbody>
                                                                <tr>
                                                                <td>{{ $imp->code_gerant }}</td>
                                                                <td>{{ $imp->nom_gerant }}</td>
                                                                <td>{{ $imp->client }}</td>
                                                                <td>{{ $imp->classement }}</td>
                                                                <td>{{ $imp->engagement }}</td>
                                                                <td>{{ $imp->type_eng_gerant }}</td>
                                                                <td>{{ $imp->date_eng_gerant }}</td>
                                                                <td>{{ $imp->montant_eng_gerant }}</td>
                                                                <td>{{ $imp->devise }}</td>
                                                                <td>{{ $imp->encours_tnd }}</td>
                                                                </tr>
                                                                </tbody>
                                                        @endforeach
                                                    </tbody>
        
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                @endif
        
                                @if(count($view_comp->impaye_besoin)>0)
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="card-description text-info">
                                            --- {{ __('Encours impayé client') }} ---
                                        </h5>
                                        <hr>
                                        <div class="form-group">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <th>{{ __('Référence') }}</th>
                                                        <th>{{ __('Type d\'impayé') }}</th>
                                                        <th>{{ __('Montant') }}</th>
                                                        <th>{{ __('Devise') }}</th>
                                                        <th>{{ __('Montant TND') }}</th>
                                                        <th>{{ __('Date') }}</th>
                                                    </thead>
                                                    @foreach ($view_comp->impaye_besoin as $imp)
                                                            <tbody>
                                                            <tr>
                                                            <td>{{ $imp->ref }}</td>
                                                            <td>{{ $imp->nature_besoin }}</td>
                                                            <td>{{ $imp->valeur_besoin }}</td>
                                                            <td>{{ $imp->devise }}</td>
                                                            <td>{{ $imp->mantant_tnd }}</td>
                                                            <td>{{ $imp->echeance_besoin }}</td>
                                                            </tr>
                                                            </tbody>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6"></div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="text-danger">{{ __('Total en TND') }}</label>
                                            <input type="text" class="form-control" id="impaye_besoin_tnd" value="{{ $impaye_client_besoin }}" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                @endif
        
                                @if(count($view_comp->impaye_leasing_compensation)>0)
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="card-description text-info">
                                                --- {{ __('Impayé Leasing - 3017') }} ---
                                            </h5>
                                            <hr>
                                            <div class="form-group">
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <th>{{ __('Num Compte') }}</th>
                                                        <th>{{ __('Solde') }}</th>
                                                        <th>{{ __('Devise') }}</th>
                                                        <th>{{ __('Date d\'ouverture') }}</th>
                                                        </thead>
                                                        @foreach ($view_comp->impaye_leasing_compensation as $impLeas)
                                                                <tbody>
                                                                <tr>
                                                                <td>{{ $impLeas->num_compte }}</td>
                                                                <td>{{ $impLeas->solde }}</td>
                                                                <td>{{ $impLeas->currency }}</td>
                                                                <td>{{ $impLeas->opening_date }}</td>
                                                                </tr>
                                                                </tbody>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endif
        
                                @if(count($view_comp->placement_compensation)>0)
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="card-description text-info">
                                            --- {{ __('Placement') }} ---
                                        </h5>
                                        <hr>
                                        <div class="form-group">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <th>{{ __('Référence') }}</th>
                                                        <th>{{ __('Nature') }}</th>
                                                        <th>{{ __('Montant') }}</th>
                                                        <th>{{ __('Devise') }}</th>
                                                        <th>{{ __('Du') }}</th>
                                                        <th>{{ __('jusq\'au') }}</th>
                                                        <th>{{ __('Taux') }}</th>
                                                        <th>{{ __('Base TMM') }}</th>
                                                        <th>{{ __('Marge Variable') }}</th>
                                                    </thead>
                                                    @foreach ($view_comp->placement_compensation as $pl)
                                                            <tbody>
                                                            <tr>
                                                            <td>{{ $pl->reference }}</td>
                                                            <td>{{ $pl->nature }}</td>
                                                            <td>{{ $pl->montant }}</td>
                                                            <td>{{ $pl->devise }}</td>
                                                            <td>{{ $pl->du }}</td>
                                                            <td>{{ $pl->au }}</td>
                                                            <td>{{ $pl->taux }}</td>
                                                            <td>{{ $pl->basetmm }}</td>
                                                            <td>{{ $pl->marge }}</td>
                                                            </tr>
                                                            </tbody>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                @endif
                                @if(count($view_comp->credit_compensation)>0)
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="card-description text-info">
                                            --- {{ __('Crédits') }} ---
                                        </h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
        
                                                <div class="form-group">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <th>{{ __('Référence') }}</th>
                                                                <th>{{ __('Libellé') }}</th>
                                                                <th>{{ __('Category') }}</th>
                                                                <th>{{ __('Encours') }}</th>
                                                                <th>{{ __('Date Echéance') }}</th>
                                                            </thead>
                                                            @foreach ($view_comp->credit_compensation as $cr)
                                                                    <tbody>
                                                                    <tr>
                                                                    <td>{{ $cr->reference }}</td>
                                                                    <td>{{ $cr->libelle }}</td>
                                                                    <td>{{ $cr->category }}</td>
                                                                    <td>{{ $cr->encours }}</td>
                                                                    <td>{{ $cr->date }}</td>
                                                                    </tr>
                                                                    </tbody>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                @endif
                                @if(count($view_comp->incident_paiement_compensation)>0)
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="card-description text-info">
                                            --- {{ __('Incident de paiement (non régularisé)') }} ---
                                        </h5>
                                        <hr>
                                        <div class="form-group">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <th>{{ __('Référence') }}</th>
                                                        <th>{{ __('Num CHQ') }}</th>
                                                        <th>{{ __('Code Présentation') }}</th>
                                                        <th>{{ __('Montant') }}</th>
                                                        <th>{{ __('Currency') }}</th>
                                                        <th>{{ __('Date Emission') }}</th>
                                                        <th>{{ __('RIB Bénéficiaire') }}</th>
                                                        <th>{{ __('Nom Bénéficiaire') }}</th>
                                                        <th>{{ __('Motif Rejet') }}</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($view_comp->incident_paiement_compensation as $ip)
        
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{ $ip->ref }}</td>
                                                                    <td>{{ $ip->num_chq }}</td>
                                                                    <td>{{ $ip->code_presentation }}</td>
                                                                    <td>{{ $ip->montant }}</td>
                                                                    <td>{{ $ip->currency }}</td>
                                                                    <td>{{ $ip->date_emission }}</td>
                                                                    <td>{{ $ip->rib_benef }}</td>
                                                                    <td>{{ $ip->nom_benef }}</td>
                                                                    <td>{{ $ip->motif_rejet }}</td>
                                                                </tr>
                                                            </tbody>
        
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
        
                                <br>
                                <h5 class="card-description text-info">--- {{ __('Chiffre d\'affaire Confié') }} ---</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('L\'année précédente') }} :</label>
                                            <input type="text" step="any" name="chiffre_ans_preced" id="chiffre_ans_preced" class="form-control " value="{{ $view_comp->chiffre_ans_preced}}" readonly />
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Cette année') }} :</label>
                                            <input type="text" step="any" id="chiffre_ans_encours" name="chiffre_ans_encours" class="form-control "  value="{{ $view_comp->chiffre_ans_encours}}" readonly/>
                                        </div>
                                    </div>
                                </div>
        
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="card-description text-info">--- {{ __('Situation Client') }} ---</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <label>{{ __('Interdit de chéquier ?') }}</label>
                                                                <div class="form-group">
                                                                    <div class="form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="interdit_chq_client" id="interdit_chq_client_oui" value="oui" @if($view_comp->interdit_chq_client =='oui') checked @endif>
                                                                        <label class="form-check-label radio-inline">{{ __('Oui') }}</label>
                                                                    </div>
                                                                    <div class="form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="interdit_chq_client" id="interdit_chq_client_non" value="non" @if($view_comp->interdit_chq_client =='non') checked @endif>
                                                                        <label class="form-check-label">{{ __('Non') }}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <label>{{ __('Date d\'interdiction') }} :</label>
                                                                <div class="form-group">
                                                                    <input type="text" name="interdit_chq_client_date" id="interdit_chq_client_date" value="{{ $view_comp->interdit_chq_client_date}}"  placeholder="jj/mm/AAAA" class="form-control " disabled/>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <label>{{ __('Nombre') }} :</label>
                                                                <div class="form-group">
                                                                    <input type="number" name="interdit_chq_client_nombre" id="interdit_chq_client_nombre" value="{{ $view_comp->interdit_chq_client_nombre}}"  class="form-control " disabled/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
        
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>{{ __('Impayé dans le secteur ?') }}</label>
                                                        <div class="form-group">
                                                            <div class="form-check-inline">
                                                                <input class="form-check-input" type="radio" name="montant_non_paye" id="montant_non_paye_oui" value="oui" @if($view_comp->montant_non_paye =='oui') checked @endif>
                                                                <label class="form-check-label">{{ __('Oui') }}</label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <input class="form-check-input" type="radio" name="montant_non_paye" id="montant_non_paye_non" value="non" @if($view_comp->montant_non_paye =='non') checked @endif>
                                                                <label class="form-check-label">{{ __('Non') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>{{ __('Chiffre d\'affaire global N') }} </label>
                                                            <input type="text" step="any" id="nb_transaction" name="nb_transaction" value="{{ $view_comp->nb_transaction}}" class="form-control "  disabled/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>{{ __('Dépassement sur les engagements ?') }}</label>
                                                        <div class="form-group">
                                                            <div class="form-check-inline">
                                                                <input class="form-check-input" type="radio" name="depassement" id="depassement_oui" value="oui" @if($view_comp->depassement =='oui') checked @endif>
                                                                <label class="form-check-label">{{ __('Oui') }}</label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <input class="form-check-input" type="radio" name="depassement" id="depassement_non" value="non" @if($view_comp->depassement =='non') checked @endif>
                                                                <label class="form-check-label">{{ __('Non') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>{{ __('Chiffre d\'affaire global N-1') }} </label>
                                                            <input type="text" step="any" id="chiffre_n" name="chiffre_n" value="{{ $view_comp->chiffre_n}}" class="form-control "  disabled/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-4">
                                                            <label>{{ __('Etat Financier fournie ?') }} </label>
                                                            <div class="form-group">
                                                                <div class="form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="liste_finance_final" id="liste_finance_final_oui" value="oui" @if($view_comp->liste_finance_final =='oui') checked @endif>
                                                                    <label class="form-check-label">{{ __('Oui') }}</label>
                                                                </div>
                                                                <div class="form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="liste_finance_final" id="liste_finance_final_non" value="non"  @if($view_comp->liste_finance_final =='non') checked @endif>
                                                                    <label class="form-check-label">{{ __('Non') }}</label>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="col-4">
                                                            <label>{{ __('Année') }} :</label>
                                                            <div class="form-group">
                                                                <input type="number" name="annee_etat_financier" id="annee_etat_financier" value="{{ $view_comp->annee_etat_financier}}" class="form-control " disabled />
                                                            </div>
                                                            </div>
                                                            <div class="col-4">
                                                            <label>{{ __('Type') }} :</label>
                                                            <div class="form-group">
                                                                <input class="form-control" name="type_etat_financier" id="type_etat_financier" value="{{ $view_comp->type_etat_financier}}" disabled>
        
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
        
        
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>{{ __('Resultat net N') }} </label>
                                                            <input type="text" step="any" id="resultat_brut" name="resultat_brut" value="{{ $view_comp->resultat_brut}}" class="form-control "  disabled/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <label>{{ __('Rapport commissaire aux comptes ?') }}</label>
                                                                <div class="form-group">
                                                                    <div class="form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="liste_finance_rapport" id="liste_finance_rapport_oui" value="oui" @if($view_comp->liste_finance_rapport =='oui') checked @endif>
                                                                        <label class="form-check-label">{{ __('Oui') }}</label>
                                                                    </div>
                                                                    <div class="form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="liste_finance_rapport" id="liste_finance_rapport_non" value="non" @if($view_comp->liste_finance_rapport =='non') checked @endif>
                                                                        <label class="form-check-label">{{ __('Non') }}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <label>{{ __('Année') }} :</label>
                                                                <div class="form-group">
                                                                    <input type="number" name="anneecommissaire" id="anneecommissaire" class="form-control " value="{{ $view_comp->anneecommissaire}}" disabled/>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <label>{{ __('Réserve') }} :</label>
                                                                <div class="form-group">
                                                                    <div class="form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="liste_finance_rapport_reserve" id="liste_finance_rapport_reserve_oui" value="oui"  @if($view_comp->liste_finance_rapport_reserve =='oui') checked @endif>
                                                                        <label class="form-check-label">{{ __('Oui') }}</label>
                                                                    </div>
                                                                    <div class="form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="liste_finance_rapport_reserve" id="liste_finance_rapport_reserve_non" value="non"  @if($view_comp->liste_finance_rapport_reserve =='non') checked @endif>
                                                                        <label class="form-check-label">{{ __('Non') }}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
        
                                                    </div>
        
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>{{ __('Resultat net N-1') }} </label>
                                                            <input type="text" step="any" id="resultat_n" name="resultat_n" value="{{ $view_comp->resultat_n}}" class="form-control " disabled />
                                                        </div>
                                                    </div>
        
                                                </div>
                                            </div>
                                        </div>
                                        @if ($view_comp->nature_tombe !== null)
                                            <br>
                                            <h5 class="card-description text-info">--- {{ __('Les tombées proches') }}---</h5>
                                            <hr>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label>{{ __('Nature') }} :</label>
                                                            <input type="text" name="nature_tombe" value="{{ $view_comp->nature_tombe}}" class="form-control "  disabled/>
                                                        </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label>{{ __('Montant') }} :</label>
                                                                <input type="text" id="montant_tombe" step="any" name="montant_tombe" value="{{ $view_comp->montant_tombe}}" class="form-control "  disabled/>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label>{{ __('Devise') }} :</label>
                                                                <input type="text" name="devise_tombe" value="{{ $view_comp->devise_tombe}}" class="form-control "  disabled/>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label>{{ __('Echéance') }} :</label>
                                                                <input type="text" name="echeance_tombe" value="{{ $view_comp->echeance_tombe}}" class="form-control "  disabled/>
                                                            </div>
                                                        </div>
        
        
                                                </div>
                                            </div>
                                        @endif
        
                                        <br>
        
                                        @if(count($view_comp->tombe_compensation)>0)
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="card-description text-info">
                                                    --- {{ __('Les tombées proches (dans 2 semaines)') }} ---
                                                </h5>
                                                <hr>
                                                <br>
        
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5 class="card-description text-info">
                                                            &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp; --- {{ __('ESCOMPTE COMMERCIAL') }} ---
                                                        </h5>
                                                        <hr>
                                                        <div class="form-group">
                                                            <div class="table-responsive">
                                                                <table class="table">
        
                                                                    <tbody>
                                                                        <tr>
                                                                        <td> </td>
                                                                        <td><input class="form-control " value="{{ $tombe }}" id="totale_escompte" readonly></td>
                                                                        <td><button class="btn btn btn-info" data-toggle="modal" data-target="#modal_escompte_comm_{{$view_comp->id}}">{{ __('Consulter') }}</button></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5 class="card-description text-info">
                                                            &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp; --- {{ __('DECOUVERTS MOBILISES') }} ---
                                                        </h5>
                                                        <hr>
                                                        <div class="form-group">
                                                            <div class="table-responsive">
                                                                <table class="table">
        
                                                                    <tbody>
                                                                        <tr>
                                                                        <td></td>
                                                                        <td><input class="form-control " value="{{ $decouvert }}" id="totale_decouvert" readonly></td>
                                                                        <td><button class="btn btn btn-info" data-toggle="modal" data-target="#modal_decouvert_mobilise_{{$view_comp->id}}">{{ __('Consulter') }}</button></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5 class="card-description text-info">
                                                            &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp; --- {{ __('AUTRES') }} ---
                                                        </h5>
                                                        <hr>
                                                        <div class="form-group">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <th></th>
                                                                        <th>{{ __('Référence') }}</th>
                                                                        <th>{{ __('Nature') }}</th>
                                                                        <th>{{ __('Montant') }}</th>
                                                                        <th>{{ __('Devise') }}</th>
                                                                        <th>{{ __('Date Echéance') }}</th>
                                                                        <th>{{ __('Date Proche') }}</th>
                                                                    </thead>
                                                                    @foreach ($view_comp->tombe_compensation as $tm)
                                                                        @if (($tm->category != 21050)&&($tm->category != 21059))
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td></td>
                                                                                    <td>{{ $tm->reference }}</td>
                                                                                    <td>{{ $tm->nature }}</td>
                                                                                    <td>{{ $tm->montant }}</td>
                                                                                    <td>{{ $tm->devise }}</td>
                                                                                    <td>{{ $tm->date_ech }}</td>
                                                                                    <td>{{ $tm->date_proche }}</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        @endif
                                                                    @endforeach
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        @endif
                                    </div>
                                </div>
        
                                @if ($view_comp->date_der_comp !== null)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="card-description text-info">--- {{ __('Informations sur la dérniere compensation') }} ---</h5>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('Date') }} :</label>
                                                        @if($view_comp->date_der_comp !== NULL)
                                                            <input type="text" value="{{ $view_comp->date_der_comp->format('d-m-Y')}}" class="form-control" disabled/>
                                                        @else
                                                            <input type="text" value="mm/jj/aaaa" class="form-control" disabled/>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('Montant') }} :</label>
                                                        <input type="text" id="montant_der_comp" step="any" name="montant_der_comp" value="{{ $view_comp->montant_der_comp}}" class="form-control" disabled/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('Décision du comité') }} :</label>
                                                        <input type="text" name="decision_der_comp" class="form-control " value="{{ $view_comp->decision_der_comp}}" disabled />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('Respect des promesses faites') }} :</label>
                                                        <div class="form-group">
                                                            <div class="form-check-inline">
                                                                <input class="form-check-input" type="radio" name="respect_promet" id="respect_promet_oui" value="oui" @if($view_comp->respect_promet =='oui') checked @endif>
                                                                <label class="form-check-label">{{ __('Oui') }}</label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <input class="form-check-input" type="radio" name="respect_promet" id="respect_promet_non" value="non" @if($view_comp->respect_promet =='non') checked @endif>
                                                                <label class="form-check-label">{{ __('Non') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('Montant des promesses faites') }} :</label>
                                                        <input type="text" id="montant_promesse" name="montant_promesse" class="form-control " value="{{ $view_comp->montant_promesse}}" disabled />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>{{ __('Promesses faites') }} :</label>
                                                        <textarea type="text" name="promesse_der_comp_update" class="form-control " disabled>{{ $view_comp->promesse_der_comp_update}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{ __('Note') }} :</label>
                                                        <textarea type="text" name="note_der_comp_update" class="form-control " disabled>{!! nl2br(htmlspecialchars($view_comp->note_der_comp_update, ENT_NOQUOTES)) !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(count($view_comp->derniere_compensation_justif)>0)
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="card-description text-info">--- {{ __('Informations sur la dérniere compensation') }} ---</h5>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('Date') }} :</label>
                                                        <input type="text" value="{{ $view_comp->date_der_comp_new}}" class="form-control" disabled/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('Montant') }} :</label>
                                                        <input type="text" id="montant_der_comp" step="any" name="montant_der_comp" value="{{ $view_comp->montant_der_comp}}" class="form-control" disabled/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('Décision du comité') }} :</label>
                                                        <input type="text" class="form-control " value="{{ $view_comp->decision_der_comp}}" disabled />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('Respect des promesses faites') }} :</label>
                                                        <div class="form-group">
                                                            <div class="form-check-inline">
                                                                <input class="form-check-input" type="radio" name="respect_promet" id="respect_promet_oui" value="oui" @if($view_comp->respect_promet =='oui') checked @endif>
                                                                <label class="form-check-label">{{ __('Oui') }}</label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <input class="form-check-input" type="radio" name="respect_promet" id="respect_promet_non" value="non" @if($view_comp->respect_promet =='non') checked @endif>
                                                                <label class="form-check-label">{{ __('Non') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
        
                                                    <div class="form-group">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <th>{{ __('Promesse faites') }}</th>
                                                                    <th>{{ __('Montant') }}</th>
                                                                </thead>
                                                                @foreach ($view_comp->derniere_compensation_justif as $jst)
                                                                        <tbody>
                                                                        <tr>
                                                                        <td>{!! nl2br(htmlspecialchars($jst->promesse_new, ENT_NOQUOTES)) !!}</td>
                                                                        <td>{{ $jst->valeur }}</td>
                                                                        </tr>
                                                                        </tbody>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{ __('Note') }} :</label>
                                                        <textarea type="text" name="note_der_comp_update" class="form-control " disabled>{!! nl2br(htmlspecialchars($view_comp->note_der_comp_update, ENT_NOQUOTES)) !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
        
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="card-description text-info">--- {{ __('Informations sur le Client') }} ---</h5>
                                        <hr>
                                        <?php
                                            if ($view_comp->interdit_chq_ben =='non') {
                                        ?>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label>{{ __('Est-ce qu\'il a d\'autres sociétés ?') }} :</label>
                                                    <div class="form-group">
                                                        <div class="form-check-inline">
                                                            <input class="form-check-input" type="radio" name="interdit_chq_ben" id="interdit_chq_ben_oui" value="oui" @if($view_comp->interdit_chq_ben =='oui') checked @endif>
                                                            <label class="form-check-label">{{ __('Oui') }}</label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <input class="form-check-input" type="radio" name="interdit_chq_ben" id="interdit_chq_ben_non" value="non" @if($view_comp->interdit_chq_ben =='non') checked @endif>
                                                            <label class="form-check-label">{{ __('Non') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{ __('Situation des sociétés du client avec la banque') }} :</label>
                                                        <input type="text" name="situation_banque_ben" class="form-control " value="{{ $view_comp->situation_banque_ben}}" disabled />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{ __('Situation du gérant et le client avec la banque') }} :</label>
                                                        <input type="text" name="situation_agent_benf" class="form-control " value="{{ $view_comp->situation_agent_benf}}" disabled />
                                                    </div>
                                                </div>
                                            </div>
        
        
                                        <?php
                                            }else{
                                        ?>
        
                                            <div class="row">
                                                <div class="col-3">
                                                    <label>{{ __('Est-ce qu\'il a d\'autres sociétés ?') }} :</label>
                                                    <div class="form-group">
                                                        <div class="form-check-inline">
                                                            <input class="form-check-input" type="radio" name="interdit_chq_ben" id="interdit_chq_ben_oui" value="oui" @if($view_comp->interdit_chq_ben =='oui') checked @endif>
                                                            <label class="form-check-label">{{ __('Oui') }}</label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <input class="form-check-input" type="radio" name="interdit_chq_ben" id="interdit_chq_ben_non" value="non" @if($view_comp->interdit_chq_ben =='non') checked @endif>
                                                            <label class="form-check-label">{{ __('Non') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <label>{{ __('code') }} :</label>
                                                    <input type="text" name="code_autre_sc" value="{{ $view_comp->code_autre_sc}}" class="form-control " id="code_autre_sc" disabled/>
                                                </div>
                                                <div class="col-3">
                                                    <label>{{ __('Nom') }} :</label>
                                                    <input type="text" name="nom_autre_sc" value="{{ $view_comp->nom_autre_sc}}" class="form-control " id="nom_autre_sc" disabled/>
                                                </div>
                                                <div class="col-3">
                                                    <label>{{ __('Activité') }} :</label>
                                                    <input type="text" name="activite_autre_sc" value="{{ $view_comp->activite_autre_sc}}" class="form-control " id="activite_autre_sc" disabled/>
                                                </div>
        
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('Situation des sociétés du client avec la banque') }} :</label>
                                                        <input type="text" name="situation_banque_ben" class="form-control " value="{{ $view_comp->situation_banque_ben}}" disabled />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('Situation du gérant et le client avec la banque') }} :</label>
                                                        <input type="text" name="situation_agent_benf" class="form-control " value="{{ $view_comp->situation_agent_benf}}" disabled />
                                                    </div>
                                                </div>
                                            </div>
        
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
        
                                <br>
                                @if(count($view_comp->autre_compte)>0)
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="card-description text-info">
                                            --- {{ __('Comptes Client') }} ---
                                        </h5>
                                        <hr>
                                        <div class="form-group">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <th>{{ __('Num Compte') }}</th>
                                                        <th>{{ __('Montant') }}</th>
                                                        <th>{{ __('Category') }}</th>
                                                    </thead>
                                                    @foreach ($view_comp->autre_compte as $cr)
                                                            <tbody>
                                                            <tr>
                                                            <td>{{ $cr->num_compte }}</td>
                                                            <td>{{ $cr->montant }}</td>
                                                            <td>{{ $cr->category }}</td>
                                                            </tr>
                                                            </tbody>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                @endif
        
        
                                <h5 class="card-description text-info">
                                    --- {{ __('Enveloppe de crédits de gestion') }} ---
                                </h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <label>{{ __('Autorisation') }} :</label>
                                        <input type="text" step="any" id="autorisation_global" class="form-control " value="{{ $view_comp->autorisation_global}}" readonly/>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <label>{{ __('Utilisation') }} :</label>
                                        <input type="text" step="any" id="utilisation_global" class="form-control " value="{{ $view_comp->utilisation_global}}" readonly/>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <label>{{ __('Disponible / Excess') }} :</label>
                                        <input type="text" step="any" id="disponible_global" class="form-control " value="{{ $view_comp->disponible_global}}" readonly/>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>{{ __('Date d\'expiration') }} :</label>
                                            @if($view_comp->date_global !== NULL)
                                                <input type="text" class="form-control " value="{{ $view_comp->date_global->format('d-m-Y')}}" readonly/>
                                            @else
                                                <input type="text" class="form-control " value="{{ $view_comp->date_global_new}}" readonly/>
                                            @endif
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                </div>
                                <br>
                                <h5 class="card-description text-info">
                                    --- {{ __('Facilité de caisse') }} ---
                                </h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <label>{{ __('Autorisation par caisse') }} :</label>
        
                                        <input type="text" step="any" class="form-control " id="valeur_decision" value="{{ $view_comp->valeur_decision}}" readonly/>
        
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <label>{{ __('Utilisation') }} :</label>
                                        <input type="text" step="any" class="form-control " id="autorisation" value="{{ $view_comp->autorisation}}" readonly/>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <label>{{ __('Disponible / Excess') }} :</label>
                                        <input type="text" step="any" class="form-control " id="disponible_autorisation" value="{{ $view_comp->disponible_autorisation}}" readonly/>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>{{ __('Date d\'expiration') }} :</label>
                                            @if($view_comp->date_exp_decision !== NULL)
                                                <input type="text" class="form-control " value="{{ $view_comp->date_exp_decision->format('d-m-Y')}}" readonly/>
                                            @else
                                                <input type="text" class="form-control " value="{{ $view_comp->date_exp_decision_new}}" readonly/>
                                            @endif
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                </div>
                                <br>
        
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ __('Solde Actuel') }} :</label>
                                            <input type="text" class="form-control " value="{{ $view_comp->solde_compensation }}" id="solde_actuel" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ __('Compensation (Compensation + Impayé à payer)') }} :</label>
                                            <input type="text" class="form-control" id="total_comp_edit" readonly/>
                                            <input type="hidden" class="form-control" value="{{ $view_comp->val_compensation +$impaye_client }}" id="total_comp" readonly/>
                                            <input type="hidden" class="form-control" value="{{ $view_comp->val_compensation}}" id="total_comp_comp" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> {{ __('Solde Après réglement') }} :</label>
                                            <input type="text" class="form-control" value="{{ $view_comp->solde_apres }}" id="soldeApr" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <br>
        
        
        
                                @if(count($view_comp->encours_compensation)>0)
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="card-description text-info">
                                            --- {{ __('Encours chèque') }} ---
                                        </h5>
                                        <hr>
                                        <div class="form-group">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <th>{{ __('Référence') }}</th>
                                                        <th>{{ __('Montant') }}</th>
                                                        <th>{{ __('Devise') }}</th>
                                                        <th>{{ __('Num Bord') }}</th>
                                                        <th>{{ __('Date d\'encaissement') }}</th>
                                                    </thead>
                                                    @foreach ($view_comp->encours_compensation as $encr)
                                                            <tbody>
                                                            <tr>
                                                            <td>{{ $encr->reference }}</td>
                                                            <td>{{ $encr->montant }}</td>
                                                            <td>{{ $encr->devise }}</td>
                                                            <td>{{ $encr->numbord }}</td>
                                                            <td>{{ $encr->date }}</td>
                                                            </tr>
                                                            </tbody>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                @endif
        
                                @if(count($view_comp->encous_effet_compensation)>0)
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="card-description text-info">
                                                --- {{ __('Encours effet à l\'encaissement') }} ---
                                            </h5>
                                            <hr>
                                            <div class="form-group">
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <th>ID</th>
                                                            <th>NUM EFFET</th>
                                                            <th>NOM TIRE</th>
                                                            <th>RIB TIRE</th>
                                                            <th>MONTANT</th>
                                                            <th>DATE ECHEANCE</th>
                                                            <th>DATE REMISE</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($view_comp->encous_effet_compensation as $eneff)
        
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{ $eneff->cfu }}</td>
                                                                        <td>{{ $eneff->num_effet }}</td>
                                                                        <td>{{ $eneff->nom_tire }}</td>
                                                                        <td>{{ $eneff->rib_tire }}</td>
                                                                        <td>{{ $eneff->montant }}</td>
                                                                        <td>{{ $eneff->date_echenace }}</td>
                                                                        <td>{{ $eneff->date_remise }}</td>
                                                                    </tr>
                                                                </tbody>
        
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endif
                                <h5 class="card-description text-info">--- {{ __('Couverture') }} ---</h5>
                                <hr>
                                @if ($view_comp->cheque_encours !== null)
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{ __('Encours chèque') }} :</label>
        
                                                <input type="text" step="any" class="form-control " id="cheque_encours" value="{{ $view_comp->cheque_encours}}" readonly />
        
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{ __('Devise d\'encours chèque') }} :</label>
                                                <input type="text" step="any" class="form-control " value="{{ $view_comp->cheque_encours_devise}}" readonly />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{ __('Date d\'encaissement') }} :</label>
                                                @if($view_comp->cheque_encours_date !== NULL)
                                                <div class="input-group date" id="dateExp" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#dateExp" name="cheque_encours_date" value="{{ $view_comp->cheque_encours_date->format('d-m-Y')}}" readonly/>
                                                    <div class="input-group-append" data-target="#dateExp" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="input-group date" id="dateExp" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#dateExp" name="cheque_encours_date" value="mm/jj/aaaa" readonly/>
                                                    <div class="input-group-append" data-target="#dateExp" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{ __('Tiré') }} :</label>
                                                <input type="text" step="any" class="form-control " value="{{ $view_comp->cheque_encours_tire}}" readonly />
        
                                            </div>
                                        </div>
                                    </div>
                                @endif
        
        
                                <div class="row">
                                    @if ($view_comp->escompte_effet !== null)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{ __('Encours effet à l\'encaissement') }} :</label>
        
                                                <input type="text" step="any" class="form-control " id="escompte_effet" value="{{ $view_comp->escompte_effet}}" readonly />
        
                                            </div>
                                        </div>
        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{ __('Effet à l\'escompte en cours d\'étude') }} :</label>
        
                                                <input type="numtextber" step="any" class="form-control " id="encaissement_effet_etude" value="{{ $view_comp->encaissement_effet_etude}}" readonly />
        
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{ __('Effet à l\'escompte en cours de validation') }} :</label>
                                                <input type="text" step="any" class="form-control " id="encaissement_effet" value="{{ $view_comp->encaissement_effet}}" readonly />
        
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{ __('Versement Espèces') }} :</label>
                                                <input type="text" step="any" class="form-control " id="versement" value="{{ $view_comp->versement}}" readonly />
        
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ __('Effet à l\'escompte en cours d\'étude') }} :</label>
                                            <input type="numtextber" step="any" class="form-control " id="encaissement_effet_etude" value="{{ $view_comp->encaissement_effet_etude}}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ __('Effet à l\'escompte en cours de validation') }} :</label>
                                            <input type="text" step="any" class="form-control " id="encaissement_effet" value="{{ $view_comp->encaissement_effet}}" readonly />
        
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ __('Versement Espèces') }} :</label>
                                            <input type="text" step="any" class="form-control " id="versement" value="{{ $view_comp->versement}}" readonly />
        
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('Note Couverture') }} :</label>
                                        <textarea type="text" rows="3" name="note_couverture" class="form-control " disabled>{{ $view_comp->note_couverture}}</textarea>
                                    </div>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Mail Bénéficiaire') }} :</label>
                                        <input type="email"
                                            id="email-benef"
                                            name="email-benef"
                                            class="form-control"
                                            value="{{ $view_comp->email_client }}"
                                            {{ Auth::user()->hasRole('Charge') ? 'required' : 'disabled' }}
                                            />
                                        <p id="emailFeedback"></p>
                                    </div>
                                    </div>
                                </div>
        
                                <div class="col-12">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Promesses') }}</label>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <th>{{ __('Justifications') }}</th>
                                                                        <th>{{ __('Montant') }}</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($view_comp->justification_comp as $justif)
                                                                        <tr>
                                                                        <td>{!! nl2br(htmlspecialchars($justif->name_justification_update, ENT_NOQUOTES)) !!}</td>
                                                                        <td>{{ $justif->value }}</td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Impayé à payer') }}</label>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <th>{{ __('Nature') }}</th>
                                                                        <th>{{ __('Montant') }}</th>
                                                                        <th>{{ __('Devise') }}</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($view_comp->impaye_client as $imp)
                                                                    <tr>
                                                                    <td>{{ $imp->nature_impaye }}</td>
                                                                    <td id="impa">{{ $imp->montant_impaye }}</td>
                                                                    <td>{{ $imp->devise_impaye }}</td>
        
                                                                    </tr>
                                                                        @endforeach
                                                                    </tbody>
        
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" class="form-control" id="TOTAL_IMPAYE" value="{{ $impaye_client }}" readonly/>
        
                                                <br>
                                                <label>{{ __('Compensation') }}</label>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <th>{{ __('Type de transaction') }}</th>
                                                                        <th>{{ __('Bénéficiaire') }}</th>
                                                                        <th>{{ __('Montant') }}</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($view_comp->detail_comp as $details)
                                                                            <tr>
                                                                                <td>{{ $details->name }}</td>
                                                                                <td>{{ $details->beneficiare }}</td>
                                                                                <td>{{ $details->value }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" class="form-control" id="solde_compensation" name="solde_compensation" value="{{ $view_comp->val_compensation }}" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="hidden" id="total_credit" class="form-control" readonly/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-danger">{{ __('Total Débit : Compensation + Impayé à payer') }}</label>
                                                <input type="text" id="total_debit" class="form-control" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                <!-- /.card -->
                </section>
            </div>
        
            <!-- /.content -->
        
                <!-- TOMBE D'ECHEANCE -->
        
                <div class="modal fade" id="modal_escompte_comm_{{$view_comp->id}}">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">ESCOMPTE COMMERCIAL</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Timelime example  -->
                            <div class="row">
                            <div class="col-12">
                                <!-- The time line -->
                                <div class="form-group">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>{{ __('Référence') }}</th>
                                            <th>{{ __('Nature') }}</th>
                                            <th>{{ __('Montant') }}</th>
                                            <th>{{ __('Devise') }}</th>
                                            <th>{{ __('Date Echéance') }}</th>
                                            <th>{{ __('Date Proche') }}</th>
                                        </thead>
                                        @foreach ($tombe_view as $tm)
                                                <tbody>
                                                <tr>
                                                <td>{{ $tm->reference }}</td>
                                                <td>{{ $tm->nature }}</td>
                                                <td>{{ $tm->montant }}</td>
                                                <td>{{ $tm->devise }}</td>
                                                <td>{{ $tm->date_ech }}</td>
                                                <td>{{ $tm->date_proche }}</td>
                                                </tr>
                                                </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            </div>
                            <!-- /.col -->
                            </div>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
        
                <div class="modal fade" id="modal_decouvert_mobilise_{{$view_comp->id}}">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">DECOUVERTS MOBILISES</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Timelime example  -->
                            <div class="row">
                            <div class="col-12">
                                <!-- The time line -->
                                <div class="form-group">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>{{ __('Référence') }}</th>
                                            <th>{{ __('Nature') }}</th>
                                            <th>{{ __('Montant') }}</th>
                                            <th>{{ __('Devise') }}</th>
                                            <th>{{ __('Date Echéance') }}</th>
                                            <th>{{ __('Date Proche') }}</th>
                                        </thead>
                                        @foreach ($decouvert_view as $tm)
                                                <tbody>
                                                <tr>
                                                <td>{{ $tm->reference }}</td>
                                                <td>{{ $tm->nature }}</td>
                                                <td>{{ $tm->montant }}</td>
                                                <td>{{ $tm->devise }}</td>
                                                <td>{{ $tm->date_ech }}</td>
                                                <td>{{ $tm->date_proche }}</td>
                                                </tr>
                                                </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            </div>
                            <!-- /.col -->
                            </div>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
        
        
        
                <!-- ENGAGEMENT CREDIT -->
                <div class="modal fade" id="modal_escompte_comm_credit{{$view_comp->id}}">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">ESCOMPTE COMMERCIAL</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Timelime example  -->
                                <div class="row">
                                    <div class="col-12">
                                        <!-- The time line -->
                                        <div class="form-group">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <th>{{ __('Référence') }}</th>
                                                        <th>{{ __('Libellé') }}</th>
                                                        <th>{{ __('Category') }}</th>
                                                        <th>{{ __('Encours') }}</th>
                                                        <th>{{ __('Date Echéance') }}</th>
                                                    </thead>
                                                    @foreach ($escompte_credit_view as $cr)
                                                            <tbody>
                                                            <tr>
                                                            <td>{{ $cr->reference }}</td>
                                                            <td>{{ $cr->libelle }}</td>
                                                            <td>{{ $cr->category }}</td>
                                                            <td>{{ $cr->encours }}</td>
                                                            <td>{{ $cr->date }}</td>
                                                            </tr>
                                                            </tbody>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <!-- /.col -->
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
        
                <div class="modal fade" id="modal_decouvert_mobilise_credit{{$view_comp->id}}">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">DECOUVERTS MOBILISES</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Timelime example  -->
                                <div class="row">
                                    <div class="col-12">
                                        <!-- The time line -->
                                        <div class="form-group">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <th>{{ __('Référence') }}</th>
                                                        <th>{{ __('Libellé') }}</th>
                                                        <th>{{ __('Category') }}</th>
                                                        <th>{{ __('Encours') }}</th>
                                                        <th>{{ __('Date Echéance') }}</th>
                                                    </thead>
                                                    @foreach ($decouvert_credit_view as $cr)
                                                            <tbody>
                                                            <tr>
                                                            <td>{{ $cr->reference }}</td>
                                                            <td>{{ $cr->libelle }}</td>
                                                            <td>{{ $cr->category }}</td>
                                                            <td>{{ $cr->encours }}</td>
                                                            <td>{{ $cr->date }}</td>
                                                            </tr>
                                                            </tbody>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <!-- /.col -->
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
        
                </div>
        
                <div class="modal fade" id="modal_financement_credit{{$view_comp->id}}">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">FINANCEMENTS EN DEVISES IMPORT</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Timelime example  -->
                                <div class="row">
                                    <div class="col-12">
                                        <!-- The time line -->
                                        <div class="form-group">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <th>{{ __('Référence') }}</th>
                                                        <th>{{ __('Libellé') }}</th>
                                                        <th>{{ __('Category') }}</th>
                                                        <th>{{ __('Encours') }}</th>
                                                        <th>{{ __('Date Echéance') }}</th>
                                                    </thead>
                                                    @foreach ($financement_credit_view as $cr)
                                                            <tbody>
                                                            <tr>
                                                            <td>{{ $cr->reference }}</td>
                                                            <td>{{ $cr->libelle }}</td>
                                                            <td>{{ $cr->category }}</td>
                                                            <td>{{ $cr->encours }}</td>
                                                            <td>{{ $cr->date }}</td>
                                                            </tr>
                                                            </tbody>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
        
        
        
              <!-- accepter -->
              <div class="modal fade" id="modal_accept_charge_{{$view_comp->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Accepter la compensation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>vous etes sur de l'accepter ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <form method="post" action="{{url('/viewCompensation/accept_charge')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$view_comp->id}}">
                            <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                            <button type="submit" class="btn btn-success swalDefaultSuccess">OUI</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- refuser -->
              <div class="modal fade" id="modal_refuse_charge_{{$view_comp->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Refuser la compensation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>vous etes sur de la rejeter ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <form method="post" action="{{url('/viewCompensation/refuse_chrage')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$view_comp->id}}">
                            <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                            <button type="submit" class="btn btn-danger swalDefaultError">OUI</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
        
              <!-- Chef d'agence -->
              <!-- accepter -->
              <div class="modal fade" id="modal_accept_chef_{{$view_comp->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Accepter la compensation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>vous etes sur de l'accepter ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <form method="post" action="{{url('/viewCompensation/accept_chef')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$view_comp->id}}">
                            <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                            <button type="submit" class="btn btn-success swalDefaultSuccess">OUI</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- refuser -->
              <div class="modal fade" id="modal_refuse_chef_{{$view_comp->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Refuser la compensation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>vous etes sur de la rejeter ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <form method="post" action="{{url('/viewCompensation/refuse_chef')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$view_comp->id}}">
                            <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                            <button type="submit" class="btn btn-danger swalDefaultError">OUI</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- Exploitation particulier -->
        
              <!-- accepter -->
              <div class="modal fade" id="modal_accept_ex_part_{{$view_comp->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Accepter la compensation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>vous etes sur de l'accepter ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <form method="post" action="{{url('/viewCompensation/accept_exp_particulier')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$view_comp->id}}">
                            <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                            <button type="submit" class="btn btn-success swalDefaultSuccess">OUI</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- refuser -->
              <div class="modal fade" id="modal_refuse_ex_part_{{$view_comp->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Refuser la compensation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>vous etes sur de la rejeter ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <form method="post" action="{{url('/viewCompensation/refuse_exp_particulier')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$view_comp->id}}">
                            <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                            <button type="submit" class="btn btn-danger swalDefaultError">OUI</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
        
              <!-- Exploitation Corporate -->
        
              <!-- accepter -->
              <div class="modal fade" id="modal_accept_ex_corp_{{$view_comp->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Accepter la compensation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>vous etes sur de l'accepter ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <form method="post" action="{{url('/viewCompensation/accept_exp_corporate')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$view_comp->id}}">
                            <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                            <button type="submit" class="btn btn-success swalDefaultSuccess">OUI</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- refuser -->
              <div class="modal fade" id="modal_refuse_ex_corp_{{$view_comp->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Refuser la compensation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>vous etes sur de la rejeter ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <form method="post" action="{{url('/viewCompensation/refuse_exp_corporate')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$view_comp->id}}">
                            <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                            <button type="submit" class="btn btn-danger swalDefaultError">OUI</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- Exploitation -->
        
                <!-- accepter -->
                <div class="modal fade" id="modal_accept_ex_{{$view_comp->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Accepter la compensation</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>vous etes sur de l'accepter ?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                            <form method="post" action="{{url('/viewCompensation/accept_exploitation')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$view_comp->id}}">
                                <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                                <button type="submit" class="btn btn-success swalDefaultSuccess">OUI</button>
                            </form>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                    <!-- /.modal -->
        
                <!-- refuser -->
                <div class="modal fade" id="modal_refuse_ex_{{$view_comp->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Refuser la compensation</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>vous etes sur de la rejeter ?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                            <form method="post" action="{{url('/viewCompensation/refuse_exploitation')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$view_comp->id}}">
                                <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                                <button type="submit" class="btn btn-danger swalDefaultError">OUI</button>
                            </form>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
        
              <!-- Risque -->
        
              <!-- accepter -->
              <div class="modal fade" id="modal_accept_rique_{{$view_comp->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Accepter la compensation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>vous etes sur de l'accepter ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <form method="post" action="{{url('/viewCompensation/accept_risque')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$view_comp->id}}">
                            <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                            <button type="submit" class="btn btn-success swalDefaultSuccess">OUI</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- refuser -->
              <div class="modal fade" id="modal_refuse_risque_{{$view_comp->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Refuser la compensation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>vous etes sur de la rejeter ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <form method="post" action="{{url('/viewCompensation/refuse_risque')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$view_comp->id}}">
                            <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                            <button type="submit" class="btn btn-danger swalDefaultError">OUI</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
              <!-- DGA -->
        
              <!-- PDG -->
              <!-- accepter -->
              <div class="modal fade" id="modal_accept_pdg_{{$view_comp->id}}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Validation de l'acceptation de la compensation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>vous êtes sûr de l'accepter ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <form method="post" action="{{url('/viewCompensation/accept_pdg')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$view_comp->id}}">
                            <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                            <button type="submit" class="btn btn-success swalDefaultSuccess">OUI</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- refuser -->
              <div class="modal fade" id="modal_refuse_pdg_{{$view_comp->id}}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Validation du rejet de la compensation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>vous êtes sûr de la rejeter ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <form method="post" action="{{url('/viewCompensation/refuse_pdg')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$view_comp->id}}">
                            <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                            <button type="submit" class="btn btn-danger swalDefaultError">OUI</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
        
              <!-- **********************************************  NOUVEAU FORMULAIRE D'AVIS ET DECISION ********************************************** -->
              <!-- Avis + decision Chef d'agence -->
              <div class="modal fade" id="modal_decision_chef_{{$view_comp->id}}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Avis par chef d'agence</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="{{url('/viewCompensation/avis_avec_decision_chef')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                        <textarea class="form-control" id="text_avis" name="text_avis" rows="3" placeholder="Donner votre avis .." required></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" name="decision" value="favorable" class="btn btn-success">Favorable</button>
                        <button type="submit" name="decision" value="defavorable" class="btn btn-danger">Défavorable</button>
                    </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- Avis + decision Charge -->
              <div class="modal fade" id="modal_decision_charge_{{$view_comp->id}}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Avis par chargé clientèle</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="{{url('/viewCompensation/avis_avec_decision_charge')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                        <textarea class="form-control" id="text_avis" name="text_avis" rows="3" placeholder="Donner votre avis .." required></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <div>
                            <button type="submit" name="decision" value="favorable" class="btn btn-success">Favorable</button>
                            <button type="submit" name="decision" value="defavorable" class="btn btn-danger">Défavorable</button>
                        </div>
                        <div>
                            <p id="warningMessage" style="color: red; display: none;">Veuillez, s'il vous plaît, renseigner une adresse e-mail en bas de l'écran précédent pour pouvoir accorder une décision favorable.</p>
                        </div>
        
                    </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
        
        
              <!-- Avis + decision Exploitation Corporat -->
              <div class="modal fade" id="modal_decision_exp_corporate_{{$view_comp->id}}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Avis par Exploitation Corporate</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="{{url('/viewCompensation/avis_avec_decision_exp_corporate')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                        <textarea class="form-control" id="text_avis" name="text_avis" rows="3" placeholder="Donner votre avis .." required></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" name="decision" value="favorable" class="btn btn-success">Favorable</button>
                        <button type="submit" name="decision" value="defavorable" class="btn btn-danger">Défavorable</button>
                    </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- Avis + decision Exploitation Particulier -->
              <div class="modal fade" id="modal_decision_exp_particulier_{{$view_comp->id}}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Avis par Exploitation Particulier et Corporate</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="{{url('/viewCompensation/avis_avec_decision_exp_particulier')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                        <textarea class="form-control" id="text_avis" name="text_avis" rows="3" placeholder="Donner votre avis .." required></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" name="decision" value="favorable" class="btn btn-success">Favorable</button>
                        <button type="submit" name="decision" value="defavorable" class="btn btn-danger">Défavorable</button>
                    </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- Avis + decision Exploitation -->
              <div class="modal fade" id="modal_decision_exp_decideur_{{$view_comp->id}}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Avis par Exploitation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="{{url('/viewCompensation/avis_avec_decision_exp')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                        <textarea class="form-control" id="text_avis" name="text_avis" rows="3" placeholder="Donner votre avis .." required></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" name="decision" value="favorable" class="btn btn-success">Favorable</button>
                        <button type="submit" name="decision" value="defavorable" class="btn btn-danger">Défavorable</button>
                    </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- Avis + decision Risque -->
              <div class="modal fade" id="modal_decision_exp_risque_{{$view_comp->id}}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Avis par Risque</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="{{url('/viewCompensation/avis_avec_decision_risque')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                        <textarea class="form-control" id="text_avis" name="text_avis" rows="3" placeholder="Donner votre avis .." required></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" name="decision" value="favorable" class="btn btn-success">Favorable</button>
                        <button type="submit" name="decision" value="defavorable" class="btn btn-danger">Défavorable</button>
                    </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- Avis + decision DG -->
              <div class="modal fade" id="modal_decision_DG_{{$view_comp->id}}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Avis par Direction Générale</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="{{url('/viewCompensation/avis_avec_decision_dg')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                        <textarea class="form-control" id="text_avis" name="text_avis" rows="3" placeholder="Donner votre avis .." required></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" name="decision" value="favorable" class="btn btn-success">Favorable</button>
                        <button type="submit" name="decision" value="defavorable" class="btn btn-danger">Défavorable</button>
                    </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- **********************************************  ARBITRAGE ********************************************** -->
        
              <!-- Arbitrage Chef d'agence -->
              <div class="modal fade" id="modal_arbitrage_chef_{{$view_comp->id}}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Demande d'un arbitrage par chef d'agence</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="{{url('/viewCompensation/avis_avec_arbitrage_chef')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                        <textarea class="form-control" id="text_avis" name="text_avis" rows="3" placeholder="Donner votre avis .." required></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" name="decision" value="favorable" class="btn btn-success">Favorable</button>
                        <button type="submit" name="decision" value="defavorable" class="btn btn-danger">Défavorable</button>
                    </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- Arbitrage Exploitation -->
              <div class="modal fade" id="modal_arbitrage_ex_{{$view_comp->id}}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Demande d'un arbitrage par Exploitation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="{{url('/viewCompensation/avis_avec_arbitrage_exploitation')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                        <textarea class="form-control" id="text_avis" name="text_avis" rows="3" placeholder="Donner votre avis .." required></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" name="decisionExp" value="favorable" class="btn btn-success">Favorable</button>
                        <button type="submit" name="decisionExp" value="defavorable" class="btn btn-danger">Défavorable</button>
                    </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- Arbitrage Risque -->
              <div class="modal fade" id="modal_arbitrage_risque_{{$view_comp->id}}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Demande d'un arbitrage par Risque</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="{{url('/viewCompensation/avis_avec_arbitrage_risque')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                        <textarea class="form-control" id="text_avis" name="text_avis" rows="3" placeholder="Donner votre avis .." required></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" name="decisionRisque" value="favorable" class="btn btn-success">Favorable</button>
                        <button type="submit" name="decisionRisque" value="defavorable" class="btn btn-danger">Défavorable</button>
                    </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
        
            <!-- **********************************************  FIN ARBITRAGE ********************************************** -->
        
              <!-- accepter -->
              <div class="modal fade" id="modal_accept_{{$view_comp->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Accepter la compensation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>vous etes sur de l'accepter ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <form method="post" action="{{url('/viewCompensation/accept')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$view_comp->id}}">
                            <button type="submit" class="btn btn-success swalDefaultSuccess">OUI</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- refuser -->
              <div class="modal fade" id="modal_refuse_{{$view_comp->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Refuser la compensation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>vous etes sur de la rejeter ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <form method="post" action="{{url('/viewCompensation/refuse')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$view_comp->id}}">
                            <button type="submit" class="btn btn-danger swalDefaultError">OUI</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- **********************************************  DECISION ********************************************** -->
        
              <!-- accepter decision -->
              <div class="modal fade" id="decision_accepter_{{$view_comp->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Decision d'acceptation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>vous etes sur de l'accepter ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <form method="post" action="{{url('/viewCompensation/acceptDetail')}}">
                            @csrf
                            <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                            <button type="submit" class="btn btn-success swalDefaultSuccess">OUI</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- refuser decision -->
              <div class="modal fade" id="decision_refuser_{{$view_comp->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Decision de refus</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>vous etes sur de la refuser ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <form method="post" action="{{url('/viewCompensation/refuser_detail')}}">
                            @csrf
                            <input type="hidden" name="compensation_id" value="{{$view_comp->id}}">
                            <button type="submit" class="btn btn-danger swalDefaultError">OUI</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- list décision -->
              <div class="modal fade" id="modal_list_decision_{{$view_comp->id}}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Historique des Décision</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!-- Timelime example  -->
                      <div class="row">
                        <div class="col-md-12">
                          <!-- The time line -->
                          <div class="timeline">
                            <!-- timeline time label -->
                            <div class="time-label">
                              <span class="bg-red">{{ now()->format('d-m-Y') }}</span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <!-- timeline item -->
                            @foreach($view_comp->compensation_status_d as $key => $decision)
                              <div>
                              <i class="fas fa-user bg-green"></i>
                              <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i>{{ $decision->created_at->format('d-m-Y H:i:s') }}</span>
                                <h3 class="timeline-header no-border">
                                  @if($decision->designation == 1)
                                  <span class="badge badge-success">Accepté par {{ $decision->user_call->name }}</span>
                                  @elseif($decision->designation == 2)
                                  <span class="badge badge-danger">Refusé par {{ $decision->user_call->name }}</span>
                                  @elseif($decision->designation == 3)
                                  <span class="badge badge-warning">Arbitrage par {{ $decision->user_call->name }}</span>
                                  @endif
                                </h3>
                              </div>
                            </div>
                            @endforeach
                            <!-- END timeline item -->
                            <div>
                              <i class="fas fa-clock bg-gray"></i>
                            </div>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
        
              <!-- **********************************************  FIN DECISION ********************************************** -->
        
              <!-- **********************************************  LES AVIS ********************************************** -->
        
              <!-- list avis -->
            <div class="modal fade" id="modal_list_avis_{{$view_comp->id}}">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Historique des Avis</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!-- Timelime example  -->
                      <div class="row">
                        <div class="col-12">
                          <!-- The time line -->
                          <div class="timeline">
                            <!-- timeline time label -->
                            <div class="time-label">
                              <span class="bg-red">{{ now()->format('d-m-Y') }}</span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <!-- timeline item -->
                            @foreach($view_comp->avis_comp as $key => $avis)
                            <div>
                              <i class="fas fa-user bg-green"></i>
                              <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i>{{ date("d-m-Y H:i:s", strtotime($avis->created_at."+1 hour")) }}</span>
                                <h3 class="timeline-header no-border"><a href="#">{{ $avis->user_func->name}} : </a> {!! nl2br(htmlspecialchars($avis->text_avis, ENT_NOQUOTES)) !!}</h3>
                                @foreach($view_comp->compensation_status_d as $key => $decision)
                                    @if (($avis->created_at->format('H:i') == $decision->created_at->format('H:i')) && ($avis->user_id == $decision->user_id))
        
                                        <h3 class="timeline-header no-border">
                                            @if($decision->designation == 1)
                                                <span class="badge badge-success">Accepté par {{ $decision->user_call->name }}</span> <span class="badge badge-success">{{ $avis->role_user}}</span>
                                            @elseif($decision->designation == 2)
                                                <span class="badge badge-danger">Refusé par {{ $decision->user_call->name }}</span> <span class="badge badge-danger">{{ $avis->role_user}}</span>
                                            @elseif($decision->designation == 3)
                                                <span class="badge badge-warning">Arbitrage par {{ $decision->user_call->name }}</span> <span class="badge badge-warning">{{ $avis->role_user}}</span>
                                            @endif
                                        </h3>
                                    @endif
                                @endforeach
                              </div>
                            </div>
                            @endforeach
                            <!-- END timeline item -->
                            <div>
                              <i class="fas fa-clock bg-gray"></i>
                            </div>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
        
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
              <!-- /.modal -->
        
              <!-- ********************************************** FIN AVIS ********************************************** -->
          </div>
        </div>
    </div>
</div>

@endsection