@extends('layout.app')

@section('title', 'Ajout Nouvelle Fiche Compensation')

@section('content')
<div class="container-fluid">
    <div class="card card-default">

    <form class="forms-sample" action="{{url('/compensation/store/ws')}}" method="POST" enctype="multipart/form-data" id="submit_form">
    @csrf
    <div class="card-header">
        <div class="card-tools">
        <button type="submit" class="btn btn-success btn-normal" id="submit_button">{{ __('Enregistrer') }}</button>
        </div>
    </div>
    <div class="card-body">
        <h4>{{ __('Nouveau Fichier') }}</h4>
        <br>

        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <span class="text-danger">{{ $error }}</span>
                        <br>
                    @endforeach
                @endif

            </div>
        </div>

        <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true">{{ __('Informations Générales') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="false">{{ __('Compensation') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="custom-content-above-client-tab" data-toggle="pill" href="#custom-content-above-client" role="tab" aria-controls="custom-content-above-client" aria-selected="false">{{ __('Client') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="custom-content-above-comp-tab" data-toggle="pill" href="#custom-content-above-comp" role="tab" aria-controls="custom-content-above-comp" aria-selected="false">Dérniere compensation</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="custom-content-above-ben-tab" data-toggle="pill" href="#custom-content-above-ben" role="tab" aria-controls="custom-content-above-ben" aria-selected="false">{{ __('Bénéficiaire') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="custom-content-above-messages-tab" data-toggle="pill" href="#custom-content-above-messages" role="tab" aria-controls="custom-content-above-messages" aria-selected="false">{{ __('Commentaires') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="custom-content-above-compte-tab" data-toggle="pill" href="#custom-content-above-compte" role="tab" aria-controls="custom-content-above-comptes" aria-selected="false">{{ __('Comptes Client') }}</a>
        </li>
        </ul>
        <div class="tab-content" id="custom-content-above-tabContent">

        @if ((count($listArrayInfGlob)>0))
        <?php
            if( isset($listArrayInfGlob[0]) ){
        ?>
            @foreach ($listArrayInfGlob as $key => $listArrayInfGlob)
                @if ($listArrayInfGlob->SIGN == 1)

                <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">

                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('Agence') }} :</label>
                                    <input type="hidden" name="code_agence" value="{{ Auth::user()->agence_id }}"/>
                                    @if (Auth::user()->agence_id == 1)
                                        <input type="text" class="form-control" value="BTL agence Tunis" readonly/>
                                        @elseif (Auth::user()->agence_id == 3)
                                        <input type="text" class="form-control" value="BTL agence Sfax" readonly/>
                                        @elseif (Auth::user()->agence_id == 4)
                                        <input type="text" class="form-control" value="BTL agence Nabeul" readonly/>
                                        @elseif (Auth::user()->agence_id == 5)
                                        <input type="text" class="form-control" value="BTL agence Petite Ariana" readonly/>
                                        @elseif (Auth::user()->agence_id == 6)
                                        <input type="text" class="form-control" value="BTL agence Ben Arous" readonly/>
                                        @elseif (Auth::user()->agence_id == 7)
                                        <input type="text" class="form-control" value="BTL agence Den Den" readonly/>
                                        @elseif (Auth::user()->agence_id == 8)
                                        <input type="text" class="form-control" value="BTL agence Sousse" readonly/>
                                        @elseif (Auth::user()->agence_id == 9)
                                        <input type="text" class="form-control" value="BTL agence Gabes" readonly/>
                                        @elseif (Auth::user()->agence_id == 11)
                                        <input type="text" class="form-control" value="BTL agence Sfax ELBOSTENE" readonly/>
                                        @elseif (Auth::user()->agence_id == 12)
                                        <input type="text" class="form-control" value="BTL agence Bizerte" readonly/>
                                        @elseif (Auth::user()->agence_id == 13)
                                        <input type="text" class="form-control" value="BTL agence Nabeul 2" readonly/>
                                        @elseif (Auth::user()->agence_id == 14)
                                        <input type="text" class="form-control" value="BTL agence Mednine" readonly/>
                                        @elseif (Auth::user()->agence_id == 15)
                                        <input type="text" class="form-control" value="BTL agence Monastir" readonly/>
                                        @elseif (Auth::user()->agence_id == 16)
                                        <input type="text" class="form-control" value="BTL agence Centre Urbain Nord" readonly/>
                                        @elseif (Auth::user()->agence_id == 17)
                                        <input type="text" class="form-control" value="BTL agence Enasr" readonly/>
                                        @elseif (Auth::user()->agence_id == 18)
                                        <input type="text" class="form-control" value="BTL agence Ariana" readonly/>
                                        @elseif (Auth::user()->agence_id == 19)
                                        <input type="text" class="form-control" value="BTL agence Lac 2" readonly/>
                                        @elseif (Auth::user()->agence_id == 20)
                                        <input type="text" class="form-control" value="BTL agence Aouina" readonly/>
                                        @elseif (Auth::user()->agence_id == 21)
                                        <input type="text" class="form-control" value="BTL agence Rasjdir" readonly/>
                                        @elseif (Auth::user()->agence_id == 22)
                                        <input type="text" class="form-control" value="BTL agence Marsa" readonly/>
                                        @elseif (Auth::user()->agence_id == 23)
                                        <input type="text" class="form-control" value="BTL agence Djerba" readonly/>
                                        @elseif (Auth::user()->agence_id == 24)
                                        <input type="text" class="form-control" value="BTL agence Megrine" readonly/>
                                    @endif
                            </div>
                        <!-- /.form-group -->
                        </div>
                        <div class="col-md-3">

                            <input type="hidden" name="user_id" value="{{ Auth::user()->name }}"/>
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date">{{ __('Date') }} :</label>
                                <input type="date" class="form-control input-sm" id="dateSys" name="date_compensation" readonly>
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('Code Client') }} :</label>
                                <input type="number" class="form-control " name="code_client" id="code_client" value="{{ $listArrayInfGlob->ID }}" readonly/>
                                <input type="hidden" class="form-control " name="account_number" value="{{ $listArrayInfGlob->ACCOUNT }}" readonly/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('Client') }} :</label>
                                <input type="text" class="form-control" name="nom_client" id="nom_client" value="{{ $listArrayInfGlob->SHORTNAME }}" readonly/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>{{ __('Date d\'ouverture du compte') }} :</label>
                                <input type="text" class="form-control input-sm" name="date_ouverture_new"
                                value="<?php    $dateConvertOu = strtotime($listArrayInfGlob->CONTACTDATE);
                                                $dateFinaleOu = date("d/m/Y",$dateConvertOu);
                                                echo $dateFinaleOu
                                        ?>" readonly>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>{{ __('Activité du société') }} :</label>
                                <input type="text" class="form-control" name="domaine_societe" value="{{ $listArrayInfGlob->LIBINDUSTRY }}" readonly/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>{{ __('Secteur') }} :</label>
                                @if (($listArrayInfGlob->SECTORCODE == 7000 )||($listArrayInfGlob->SECTORCODE == 7100 ))
                                    <input type="hidden" class="form-control" name="secteur_client" value="particulier" readonly/>
                                    <input type="text" class="form-control" name="name_secteur" value="{{ $listArrayInfGlob->DESCRIPTION }}" readonly/>
                                @else
                                    <input type="hidden" class="form-control" name="secteur_client" value="corporate" readonly/>
                                    <input type="text" class="form-control" name="name_secteur" value="{{ $listArrayInfGlob->DESCRIPTION }}" readonly/>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Identifiant Bénéficiaire Effectif') }}:</label>
                                <?php
                                    if(isset($listArrayInfGlob->IDBENEFICIAIRE)){
                                ?>
                                <input type="text" class="form-control " name="id_benef" value="{{ $listArrayInfGlob->IDBENEFICIAIRE }}" readonly/>
                                <?php
                                    }else{
                                ?>
                                <input type="text" class="form-control " name="id_benef" value=" " readonly/>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Bénéficiaire Effectif') }}:</label>
                                <?php
                                    if(isset($listArrayInfGlob->BENEFICIAIRE)){
                                ?>
                                <input type="text" class="form-control " name="beneficiare" value="{{ $listArrayInfGlob->BENEFICIAIRE }}" readonly/>
                                <?php
                                    }else{
                                ?>
                                <input type="text" class="form-control " name="beneficiare" value=" " readonly/>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!--GERANT-->
                    <br>
                    <hr>
                    <h5 class="card-description text-info">
                        --- {{ __('Engagement du gérant avec la banque') }} ---
                    </h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="tableGerant">
                            <thead>
                                <th>CODE</th>
                                <th>NAME</th>
                                <th>CLIENT</th>
                                <th>CLASSEMENT</th>
                                <th>ENGAGEMENT</th>
                                <th>LIBELLE</th>
                                <th>DATE ECHENACE</th>
                                <th>ENCOURS</th>
                                <th>CURRENCY</th>
                                <th>ENCOURS TND</th>
                            </thead>
                            <tbody>
                                @if ((count($listArrayEngGer)>0))

                                    <?php
                                        if(isset($listArrayEngGer[0])){
                                    ?>
                                        @foreach ($listArrayEngGer as $key => $listArrayEngGer)
                                        <tr>
                                            <input type="hidden" name="engagement_store" value="notEmpty">
                                            <td><input class="form-control" name="code_gerant[]" value="{{ $listArrayEngGer->SIGNATORY }}" readonly></td>
                                            <td><input class="form-control" name="nom_gerant[]" value="{{ $listArrayEngGer->SIGNATORYNAME }}" readonly></td>
                                            <td><input class="form-control" name="client[]" value="{{ $listArrayEngGer->CLIENTBANQUE }}" readonly></td>
                                            @if (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer->CLASSEMENT == 0)
                                                <td><input type="text" class="form-control" name="classementEng[]" value="CREANCES COURANTES - 0" readonly/></td>
                                            @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer->CLASSEMENT == 1)
                                                <td><input type="text" class="form-control" name="classementEng[]" value="CREANCES NECESSITANT UN SUIVI PARTICULIER - 1" readonly/></td>
                                            @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer->CLASSEMENT == 2)
                                                <td><input type="text" class="form-control" name="classementEng[]" value="CREANCES INCERTAINTES - 2" readonly/></td>
                                            @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer->CLASSEMENT == 3)
                                                <td><input type="text" class="form-control" name="classementEng[]" value="CREANCES PREOCCUPANTES - 3" readonly/></td>
                                            @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer->CLASSEMENT == 4)
                                                <td><input type="text" class="form-control" name="classementEng[]" value="CREANCES COMPROMESES - 4" readonly/></td>
                                            @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer->CLASSEMENT == 5)
                                                <td><input type="text" class="form-control" name="classementEng[]" value="CREANCES AU CONTENTIEUX - 5" readonly/></td>
                                            @endif
                                            <?php
                                            if(isset($listArrayEngGer->ENGAGEMENT)){
                                            ?>
                                            <td><input class="form-control" name="engagement[]" value="{{ $listArrayEngGer->ENGAGEMENT }}" readonly></td>
                                            <td><input class="form-control" name="type_eng_gerant[]" value="{{ $listArrayEngGer->LIBELLE }}" readonly></td>
                                            <td><input class="form-control" name="date_eng_gerant[]" value="{{ $listArrayEngGer->ECHEDATE }}" readonly></td>
                                            <td><input class="form-control" name="montant_eng_gerant[]" value="{{ $listArrayEngGer->ENCOURS }}" readonly></td>
                                            <td><input class="form-control" name="devise[]" value="{{ $listArrayEngGer->CURRENCY }}" readonly></td>
                                            <td><input class="form-control" name="encours_tnd[]" value="{{ $listArrayEngGer->ENCOURSTND }}" readonly></td>


                                            <?php
                                            }else{
                                            ?>

                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>

                                            <?php
                                            }
                                            ?>

                                        </tr>
                                        @endforeach
                                    <?php
                                        }else{
                                    ?>
                                        <tr>
                                            <td><input class="form-control" name="code_gerant" value="{{ $listArrayEngGer['SIGNATORY'] }}" readonly></td>
                                            <td><input class="form-control" name="nom_gerant" value="{{ $listArrayEngGer['SIGNATORYNAME'] }}" readonly></td>
                                            <td><input class="form-control" name="client" value="{{ $listArrayEngGer['CLIENTBANQUE'] }}" readonly></td>
                                            @if (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer['CLASSEMENT'] == 0)
                                                <td><input type="text" class="form-control" name="classementEng" value="CREANCES COURANTES - 0" readonly/></td>
                                            @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer['CLASSEMENT'] == 1)
                                                <td><input type="text" class="form-control" name="classementEng" value="CREANCES NECESSITANT UN SUIVI PARTICULIER - 1" readonly/></td>
                                            @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer['CLASSEMENT'] == 2)
                                                <td><input type="text" class="form-control" name="classementEng" value="CREANCES INCERTAINTES - 2" readonly/></td>
                                            @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer['CLASSEMENT'] == 3)
                                                <td><input type="text" class="form-control" name="classementEng" value="CREANCES PREOCCUPANTES - 3" readonly/></td>
                                            @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer['CLASSEMENT'] == 4)
                                                <td><input type="text" class="form-control" name="classementEng" value="CREANCES COMPROMESES - 4" readonly/></td>
                                            @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer['CLASSEMENT'] == 5)
                                                <td><input type="text" class="form-control" name="classementEng" value="CREANCES AU CONTENTIEUX - 5" readonly/></td>
                                            @endif
                                            <?php
                                            if(isset($listArrayEngGer['ENGAGEMENT'])){
                                            ?>
                                            <td><input class="form-control" name="engagement" value="{{ $listArrayEngGer['ENGAGEMENT'] }}" readonly></td>
                                            <td><input class="form-control" name="type_eng_gerant" value="{{ $listArrayEngGer['LIBELLE'] }}" readonly></td>
                                            <td><input class="form-control" name="date_eng_gerant" value="{{ $listArrayEngGer['ECHEDATE'] }}" readonly></td>
                                            <td><input class="form-control" name="montant_eng_gerant" value="{{ $listArrayEngGer['ENCOURS'] }}" readonly></td>

                                            <td><input class="form-control" name="devise" value="{{ $listArrayEngGer['CURRENCY'] }}" readonly></td>
                                            <td><input class="form-control" name="encours_tnd" value="{{ $listArrayEngGer['ENCOURSTND'] }}" readonly></td>

                                            <?php
                                            }else{
                                            ?>

                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <h5 class="card-description text-info">
                        --- {{ __('Engagement du gérant sur le SED') }} ---
                    </h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Crédit au particulier') }} :</label>
                                <div class="custom-file">
                                    <input type="file" name="credit_particulier_gerant" class="custom-file-input" id="credit_particulier_gerant" accept=".pdf" disabled>
                                    <label class="custom-file-label" for="credit_particulier_gerant"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Classement') }} :</label>
                                <div class="custom-file">
                                    <input type="file" name="classement_gerant" class="custom-file-input" id="classement_gerant" accept=".pdf" disabled>
                                    <label class="custom-file-label" for="classement_gerant"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Chèque impayé') }} :</label>
                                <div class="custom-file">
                                    <input type="file" name="cheque_impaye_gerant" class="custom-file-input" id="cheque_impaye_gerant" accept=".pdf" disabled>
                                    <label class="custom-file-label" for="cheque_impaye_gerant"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!--GERANT-->
                </div>

                <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Devise de compensation') }} :</label>
                                <input type="text" class="form-control " name="devise_compensation" value="TND" readonly/>
                            </div>
                        </div>
                    </div>

                    <br>
                    <h5 class="card-description text-info">
                        --- {{ __('Placement') }} ---
                    </h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="placement_table">
                            <thead>
                                <th>Référence</th>
                                <th>Nature du placement</th>
                                <th>Montant</th>
                                <th>Devise</th>
                                <th>Du</th>
                                <th>Jusqu'au</th>
                                <th>Taux du placement</th>
                                <th>Base TMM</th>
                                <th>Marge Variable</th>
                            </thead>
                            <tbody>
                                @if ((count($listArrayPlacement)>0))
                                    <?php
                                        if(isset($listArrayPlacement[0])){
                                    ?>
                                        @foreach ($listArrayPlacement as $key => $listArrayPlacement)
                                        <tr>
                                            <input type="hidden" name="placement_compensation" value="notEmty">
                                            <td><input class="form-control" name="referenceP[]" value="{{ $listArrayPlacement->ID }}" readonly></td>
                                            <td><input class="form-control" name="natureP[]" value="{{ $listArrayPlacement->LCATEGORY }}" readonly></td>
                                            <td><input class="form-control" name="montantP[]" value="{{ $listArrayPlacement->AMOUNT }}" readonly></td>
                                            <td><input class="form-control" name="deviseP[]" value="{{ $listArrayPlacement->CURRENCY }}" readonly></td>
                                            <td><input class="form-control" name="du[]" value="{{ $listArrayPlacement->VALUEDATE }}" readonly></td>
                                            <td><input class="form-control" name="au[]" value="{{ $listArrayPlacement->FINMATDATE }}" readonly></td>
                                            <td><input class="form-control" name="taux[]" value="{{ $listArrayPlacement->INTERESTRATE }}" readonly></td>

                                            <?php
                                            if(isset($listArrayPlacement->TMMTX)){
                                            ?>

                                            <td><input class="form-control" name="basetmm[]" value="{{ $listArrayPlacement->TMMTX }}" readonly></td>
                                            <td><input class="form-control" name="marge[]" value="{{ $listArrayPlacement->MARGETX }}" readonly></td>

                                            <?php
                                            }else{
                                            ?>

                                            <td><input class="form-control" readonly></td>
                                            <td><input class="form-control" readonly></td>

                                            <?php
                                            }
                                            ?>

                                        </tr>
                                        @endforeach
                                    <?php
                                        }else{
                                    ?>
                                        <tr>
                                            <td><input class="form-control" name="referenceP" value="{{ $listArrayPlacement['ID'] }}" readonly></td>
                                            <td><input class="form-control" name="natureP" value="{{ $listArrayPlacement['LCATEGORY'] }}" readonly></td>
                                            <td><input class="form-control" name="montantP" value="{{ $listArrayPlacement['AMOUNT'] }}" readonly></td>
                                            <td><input class="form-control" name="deviseP" value="{{ $listArrayPlacement['CURRENCY'] }}" readonly></td>
                                            <td><input class="form-control" name="du" value="{{ $listArrayPlacement['VALUEDATE'] }}" readonly></td>
                                            <td><input class="form-control" name="au" value="{{ $listArrayPlacement['FINMATDATE'] }}" readonly></td>
                                            <td><input class="form-control" name="taux" value="{{ $listArrayPlacement['INTERESTRATE'] }}" readonly></td>
                                            <?php
                                            if(isset($listArrayPlacement['TMMTX'])){
                                            ?>
                                            <td><input class="form-control" name="basetmm" value="{{ $listArrayPlacement['TMMTX'] }}" readonly></td>
                                            <td><input class="form-control" name="marge" value="{{ $listArrayPlacement['MARGETX'] }}" readonly></td>

                                            <?php
                                            }else{
                                            ?>

                                            <td> </td>
                                            <td> </td>

                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <br>
                    <h5 class="card-description text-info">
                        --- {{ __('Crédits') }} ---
                    </h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="credit_client">
                            <thead>
                                <th>Référence</th>
                                <th>Libellé</th>
                                <th>Category</th>
                                <th>Encours</th>
                                <th>Date Echéance</th>
                            </thead>
                            <tbody>
                                @if ((count($listArrayEngCred)>0))
                                <?php
                                    if(isset($listArrayEngCred[0])){
                                ?>
                                @foreach ($listArrayEngCred as $listArrayEngCred)

                                <tr>

                                    <?php
                                        $limit = $listArrayEngCred->LIMITREFRENCE;
                                        if((str_starts_with($limit,'5000'))||(str_starts_with($limit,'5100'))||(str_starts_with($limit,'5200'))||(str_starts_with($limit,'5300'))||(str_starts_with($limit,'5400'))||(str_starts_with($limit,'5500'))){
                                    ?>
                                    <input type="hidden" name="credit_compensation" value="notEmty">
                                    <td><?php  $engagement = $listArrayEngCred->ENGAGEMENT  ?><input class="form-control" name="referenceCred[]" value="{{ $engagement }}" readonly></td>

                                    <?php
                                        if( isset($listArrayEngCred->LIBELLECREDIT) ){
                                        $lib =  $listArrayEngCred->LIBELLECREDIT
                                    ?>
                                        <td><input class="form-control" name="libelleCred[]" value="{{ $lib }}" readonly></td>
                                    <?php
                                        }else{
                                    ?>
                                        <td><input class="form-control" name="libelleCred[]" value=" " readonly></td>
                                    <?php
                                        }
                                    ?>

                                    <td><?php $cat =  $listArrayEngCred->CATEGORY ?><input class="form-control" name="categoryCred[]" value="{{ $cat }}" readonly></td>
                                    <td><?php $enc =  $listArrayEngCred->ENCOURS ?><input class="form-control" name="encoursCred[]" value="{{ $enc }}" readonly></td>
                                    <td><?php   $dateConverti = strtotime($listArrayEngCred->ECHEDATE );
                                                $dateFinale = date("d/m/Y",$dateConverti);
                                                $datef =  $dateFinale ?><input class="form-control" name="dateCred[]" value="{{ $datef }}" readonly></td>
                                    <?php
                                        }
                                    ?>
                                </tr>
                                @endforeach
                                <?php
                                }else{
                                ?>
                                <tr>
                                    <?php
                                        $limit = $listArrayEngCred['LIMITREFRENCE'];
                                        if((str_starts_with($limit,'5000'))||(str_starts_with($limit,'5100'))||(str_starts_with($limit,'5200'))||(str_starts_with($limit,'5300'))||(str_starts_with($limit,'5400'))||(str_starts_with($limit,'5500'))){
                                    ?>
                                    <td><input class="form-control" name="referenceCred" value="{{ $listArrayEngCred['ENGAGEMENT'] }}" readonly></td>
                                    <td><input class="form-control" name="libelleCred" value="{{ $listArrayEngCred['LIBELLECREDIT'] }}" readonly></td>
                                    <td><input class="form-control" name="categoryCred" value="{{ $listArrayEngCred['CATEGORY'] }}" readonly></td>
                                    <td><input class="form-control" name="encoursCred" value="{{ $listArrayEngCred['ENCOURS'] }}" readonly></td>
                                    <td><?php   $dateConverti = strtotime($listArrayEngCred['ECHEDATE']);
                                        $dateFinale = date("d/m/Y",$dateConverti);
                                        $datef =   $dateFinale ?><input class="form-control" name="dateCred" value="{{ $datef }}" readonly>
                                    </td>
                                    <?php
                                        }
                                    ?>
                                </tr>
                                <?php
                                } ?>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <br>
                    <h5 class="card-description text-info">
                        --- {{ __('Ligne de crédit de gestion') }} ---
                    </h5>
                    <hr>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Autorisation :</label>
                            <input type="number" step="any" class="form-control " id="autorisation_global" name="autorisation_global" value="{{ $first_line->PCOMM }}" readonly/>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Utilisation :</label>
                            <input type="number" step="any" class="form-control " name="utilisation_global" id="utilisation_global" value="{{ $first_line->POSAMT }}" readonly/>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Disponible :</label>
                            <input type="number" step="any" class="form-control " name="disponible_global" id="disponible_global" value="{{ $first_line->PAVAIL }}" readonly/>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('Date d\'expiration') }} :</label>
                                <input type="text" class="form-control input-sm" name="date_global_new" value="{{ $first_line->EXP }}" readonly>
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
                            <label>Autorisation :</label>
                            <input type="number" step="any" class="form-control " value="{{ $second_line->PCOMM }}" name="valeur_decision" id="valeur_decision" readonly/>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Utilisation :</label>
                            <input type="number" step="any" class="form-control " value="{{ $second_line->POSAMT }}" name="autorisation" id="autorisation_facilite" readonly/>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Disponible :</label>
                            <input type="number" step="any" class="form-control " value="{{ $second_line->PAVAIL }}" name="disponible_autorisation" id="disponible_autorisation" readonly/>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('Date d\'expiration') }} :</label>
                                <input type="text" class="form-control input-sm" name="date_exp_decision_new" value="{{ $second_line->EXP }}" readonly>
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>

                    <br>
                    <h5 class="card-description text-info">
                        --- {{ __('Encours impayé client') }} ---
                    </h5>
                    <hr>
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table ">
                                <thead>
                                    <th>{{ __('Référence') }}</th>
                                    <th>{{ __('Type d\'impayé') }}</th>
                                    <th>{{ __('Montant') }}</th>
                                    <th>{{ __('Devise') }}</th>
                                    <th>{{ __('Montant en TND') }}</th>
                                    <th>{{ __('Date') }}</th>
                                </thead>
                                <tbody>
                                    @if ((count($listArrayImp)>0))
                                    <?php
                                        if(isset($listArrayImp[0])){
                                    ?>
                                    @foreach ($listArrayImp as $listArrayImp)
                                    <tr>
                                        <input type="hidden" name="impaye_compensation" value="notempty">
                                        <td><input class="form-control" name="refImp[]" value="{{ $listArrayImp->ID }}" readonly></td>
                                        <td><input class="form-control" name="nature_besoinImp[]" value="{{ $listArrayImp->DESCRIPTION }}" readonly></td>
                                        <td><input class="form-control" name="valeur_besoinImp[]" value="{{ $listArrayImp->TOTALAMTTOREPAY }}" readonly></td>
                                        <td><input class="form-control" name="deviseImp[]" value="{{ $listArrayImp->CURRENCY }}" readonly></td>
                                        <td><input class="form-control" name="mantant_tndImp[]" value="{{ $listArrayImp->TOTALAMTTOREPAYTND }}" readonly></td>
                                        <td><?php   $dateConvertimp = strtotime($listArrayImp->PAYMENTDTEDUE);
                                            $dateFinaleimp = date("d/m/Y",$dateConvertimp);
                                        ?>
                                        <input class="form-control" name="echeance_besoinImp[]" value="{{ $dateFinaleimp }}" readonly>
                                        </td>
                                    </tr>
                                    @endforeach

                                        <?php }else{
                                            ?>
                                        <tr>
                                            <td><input class="form-control" name="refImp" value="{{ $listArrayImp['ID'] }}" readonly></td>
                                            <td><input class="form-control" name="nature_besoinImp" value="{{ $listArrayImp['DESCRIPTION'] }}" readonly></td>
                                            <td><input class="form-control" name="valeur_besoinImp" value="{{ $listArrayImp['TOTALAMTTOREPAY'] }}" readonly></td>
                                            <td><input class="form-control" name="deviseImp" value="{{ $listArrayImp['CURRENCY'] }}" readonly></td>
                                            <td><input class="form-control" name="mantant_tndImp" value="{{ $listArrayImp['TOTALAMTTOREPAYTND'] }}" readonly></td>
                                            <td><?php   $dateConvertimp = strtotime($listArrayImp['PAYMENTDTEDUE']);
                                                $dateFinaleimp = date("d/m/Y",$dateConvertimp);
                                                ?><input class="form-control" name="echeance_besoinImp" value="{{ $dateFinaleimp}}" readonly>
                                            </td>
                                        </tr>

                                    <?php
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br>
                    <h5 class="card-description text-info">
                        --- {{ __('Impayés de Leasing - 3017') }} ---
                    </h5>
                    <hr>
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table ">
                                <thead>
                                    <th>{{ __('Num Compte') }}</th>
                                    <th>{{ __('Solde') }}</th>
                                    <th>{{ __('Devise') }}</th>
                                    <th>{{ __('Date d\'ouverture') }}</th>
                                </thead>
                                <tbody>
                                    @if ((count($listArrayLeas)>0))
                                    <?php
                                        if(isset($listArrayLeas[0])){
                                    ?>
                                    @foreach ($listArrayLeas as $listArrayLeas)
                                    <tr>
                                        <input type="hidden" name="impaye_compensation_leasing" value="notempty">
                                        <td><input class="form-control" name="num_compte_ImpLeasing[]" value="{{ $listArrayLeas->ID }}" readonly></td>
                                        <td><input class="form-control" name="solde_leasing[]" value="{{ $listArrayLeas->WORKINGBALANCE }}" readonly></td>
                                        <td><input class="form-control" name="devise_leasing[]" value="{{ $listArrayLeas->CURRENCY }}" readonly></td>
                                        <td>
                                            <?php
                                            $dateConvertimp = strtotime($listArrayLeas->OPENINGDATE);
                                            $dateFinaleimp = date("d/m/Y",$dateConvertimp);
                                            ?>
                                        <input class="form-control" name="date_ouverture_leasing[]" value="{{ $dateFinaleimp }}" readonly>
                                        </td>
                                    </tr>
                                    @endforeach

                                        <?php }else{
                                            ?>
                                        <tr>
                                            <td><input class="form-control" name="num_compte_ImpLeasing" value="{{ $listArrayLeas['ID'] }}" readonly></td>
                                            <td><input class="form-control" name="solde_leasing" value="{{ $listArrayLeas['WORKINGBALANCE'] }}" readonly></td>
                                            <td><input class="form-control" name="devise_leasing" value="{{ $listArrayLeas['CURRENCY'] }}" readonly></td>
                                            <td>
                                            <?php
                                                $dateConvertimp = strtotime($listArrayLeas['OPENINGDATE']);
                                                $dateFinaleimp = date("d/m/Y",$dateConvertimp);
                                                ?>
                                            <input class="form-control" name="date_ouverture_leasing" value="{{ $dateFinaleimp}}" readonly>
                                            </td>
                                        </tr>

                                    <?php
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <br>
                    <h5 class="card-description text-info">
                        --- {{ __('Incident de paiement') }} ---
                    </h5>
                    <hr>
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table ">
                                <thead>
                                    <th>REF</th>
                                    <th>NUM CHQ</th>
                                    <th>CODE PRESENTATION</th>
                                    <th>MONTANT</th>
                                    <th>CURRENCY</th>
                                    <th>DATE EMISSION</th>
                                    <th>RIB BENEFICIAIRE</th>
                                    <th>NOM BENEFICIAIRE</th>
                                    <th>MOTIF REJET</th>
                                </thead>
                                <tbody>
                                    @if ((count($listArrayIP)>0))
                                    <?php
                                        if(isset($listArrayIP[0])){
                                    ?>
                                    @foreach ($listArrayIP as $listArrayIP)
                                        @if ($listArrayIP->DATEREGULE == 'EMPTY')
                                            <tr>
                                                <input type="hidden" name="incident_paiement" value="notempty">
                                                <td><input class="form-control" name="refIncident[]" value="{{ $listArrayIP->ID }}" readonly></td>
                                                <?php
                                                    if(isset($listArrayIP->NUMCHQ)){
                                                ?>
                                                    <td><input class="form-control" name="numChqIncident[]" value="{{ $listArrayIP->NUMCHQ }}" readonly></td>
                                                <?php
                                                    }else{
                                                ?>
                                                    <td><input class="form-control" name="numChqIncident[]" value=" " readonly></td>
                                                <?php
                                                    }
                                                ?>
                                                <?php
                                                if(isset($listArrayIP->CODEPRESENTATION)){
                                                ?>
                                                    <td><input class="form-control" name="codeIncident[]" value="{{ $listArrayIP->CODEPRESENTATION }}" readonly></td>
                                                <?php
                                                    }else{
                                                ?>
                                                    <td><input class="form-control" name="codeIncident[]" value=" " readonly></td>
                                                <?php
                                                    }
                                                ?>
                                                <?php
                                                if(isset($listArrayIP->MONTANT)){
                                            ?>
                                                <td><input class="form-control" name="montantIncident[]" value="{{ $listArrayIP->MONTANT }}" readonly></td>
                                            <?php
                                                }else{
                                            ?>
                                                <td><input class="form-control" name="montantIncident[]" value=" " readonly></td>
                                            <?php
                                                }
                                            ?>
                                                <?php
                                                if(isset($listArrayIP->CURRENCY)){
                                            ?>
                                                <td><input class="form-control" name="currencyIncident[]" value="{{ $listArrayIP->CURRENCY }}" readonly></td>
                                            <?php
                                                }else{
                                            ?>
                                                <td><input class="form-control" name="currencyIncident[]" value=" " readonly></td>
                                            <?php
                                                }
                                            ?>

                                    <td>
                                        <?php
                                            if(isset($listArrayIP->DATEEMISSION)){
                                                $dateConvertimp = strtotime($listArrayIP->DATEEMISSION);
                                                $dateFinaleimp = date("d/m/Y",$dateConvertimp);
                                        ?>
                                                <input class="form-control" name="dateIncident[]" value="{{ $dateFinaleimp }}" readonly>
                                        <?php
                                        }else{
                                        ?>
                                                <td><input class="form-control" name="dateIncident[]" value=" " readonly></td>
                                        <?php
                                            }
                                        ?>
                                    </td>

                                                <?php
                                                    if(isset($listArrayIP->RIBBENEF)){
                                                ?>
                                                    <td><input class="form-control" name="ribIncident[]" value="{{ $listArrayIP->RIBBENEF }}" readonly></td>
                                                <?php
                                                    }else{
                                                ?>
                                                    <td><input class="form-control" name="ribIncident[]" value=" " readonly></td>
                                                <?php
                                                    }

                                                    if(isset($listArrayIP->NOMBENEF)){
                                                ?>
                                                    <td><input class="form-control" name="nomBenefIncident[]" value="{{ $listArrayIP->NOMBENEF }}" readonly></td>
                                                <?php
                                                    }else{
                                                ?>
                                                    <td><input class="form-control" name="nomBenefIncident[]" readonly></td>
                                                <?php
                                                    }
                                                ?>

<?php
if(isset($listArrayIP->MOTIFREJET)){
?>
<td><input class="form-control" name="motifIncident[]" value="{{ $listArrayIP->MOTIFREJET }}" readonly></td>
<?php
}else{
?>
<td><input class="form-control" name="motifIncident[]" value=" " readonly></td>
<?php
}
?>
                                                <input type="hidden" name="DATEREGULEIncident[]" value="{{ $listArrayIP->DATEREGULE }}">
                                                <?php
if(isset($listArrayIP->STADEINC)){
?>
<input type="hidden" class="form-control" name="STADEIncident[]" value="{{ $listArrayIP->STADEINC }}">
<?php
}else{
?>
<input type="hidden" class="form-control" name="STADEIncident[]" value=" " >
<?php
}
?>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <?php
                                        }else{
                                    ?>

                                    @if ($listArrayIP['DATEREGULE'] == 'EMPTY')
                                        <tr>
                                            <td><input class="form-control" name="refIncident" value="{{ $listArrayIP['ID'] }}" readonly></td>
                                            <?php
                                                if(isset($listArrayIP['NUMCHQ'])){
                                            ?>
                                                <td><input class="form-control" name="numChqIncident" value="{{ $listArrayIP['NUMCHQ'] }}" readonly></td>
                                            <?php
                                                }else{
                                            ?>
                                                <td><input class="form-control" name="numChqIncident" value=" " readonly></td>
                                            <?php
                                                }
                                            ?>
                                            <?php
                                            if(isset($listArrayIP['CODEPRESENTATION'])){
                                            ?>
                                                <td><input class="form-control" name="codeIncident" value="{{ $listArrayIP['CODEPRESENTATION'] }}" readonly></td>
                                            <?php
                                                }else{
                                            ?>
                                                <td><input class="form-control" name="codeIncident" value=" " readonly></td>
                                            <?php
                                                }
                                            ?>

                                            <?php
                                            if(isset($listArrayIP['MONTANT'])){
                                            ?>
                                            <td><input class="form-control" name="montantIncident" value="{{ $listArrayIP['MONTANT'] }}" readonly></td>
                                            <?php
                                            }else{
                                            ?>
                                            <td><input class="form-control" name="montantIncident" value=" " readonly></td>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if(isset($listArrayIP['CURRENCY'])){
                                        ?>
                                            <td><input class="form-control" name="currencyIncident" value="{{ $listArrayIP['CURRENCY'] }}" readonly></td>
                                        <?php
                                            }else{
                                        ?>
                                            <td><input class="form-control" name="currencyIncident" value=" " readonly></td>
                                        <?php
                                            }
                                        ?>
                                            <td>
                                                <?php
                                                        if(isset($listArrayIP['DATEEMISSION'])){
                                                        $dateConvertimp = strtotime($listArrayIP['DATEEMISSION']);
                                                        $dateFinaleimp = date("d/m/Y",$dateConvertimp);
                                                ?>
                                                <input class="form-control" name="dateIncident" value="{{ $dateFinaleimp}}" readonly>
                                                <?php
                                                }else{
                                                ?>
                                                        <td><input class="form-control" name="dateIncident" value=" " readonly></td>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                            <td><input class="form-control" name="ribIncident" value="{{ $listArrayIP['RIBBENEF'] }}" readonly></td>
                                            <td><input class="form-control" name="nomBenefIncident" value="{{ $listArrayIP['NOMBENEF'] }}" readonly></td>
                                            <?php
if(isset($listArrayIP['MOTIFREJET'])){
?>
<td><input class="form-control" name="motifIncident" value="{{ $listArrayIP['MOTIFREJET'] }}" readonly></td>
<?php
}else{
?>
<td><input class="form-control" name="motifIncident" value=" " readonly></td>
<?php
}
?>
                                            <input type="hidden" name="DATEREGULEIncident" value="{{ $listArrayIP['DATEREGULE'] }}">
                                            <?php
if(isset($listArrayIP['STADEINC'])){
?>
<input type="hidden" class="form-control" name="STADEIncident" value="{{ $listArrayIP['STADEINC'] }}" >
<?php
}else{
?>
<input type="hidden" class="form-control" name="STADEIncident" value=" " >
<?php
}
?>
                                        </tr>
                                    @endif

                                    <?php
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br>
                    <div class="col-12">
                        <!-- radio -->
                        <h5 class="card-description text-info"><span class="text-danger">* </span>
                            --- {{ __('Compensation') }} ---
                        </h5>
                        <hr>
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table" id="tab_logic">
                                    <thead>
                                        <th><span class="text-danger">* </span>Type de transaction</th>
                                        <th><span class="text-danger">* </span>Bénéficiaire</th>
                                        <th><span class="text-danger">* </span>Montant</th>
                                        <th class="text-center"></th>
                                    </thead>
                                    <tbody>
                                        <tr id='addr0'></tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="8"></td>
                                            <td>
                                                <a id="add_row" class="btn btn-info"><i
                                                        class="fa fa-plus"></i></a>
                                            </td>
                                            <tr>
                                                <td class="text-center text-danger font-weight-bold">{{__('Total')}}</td>
                                                <td colspan="2">
                                                    <input id="Total_TTC" name='val_compensation' type='text'
                                                        class='form-control input-md'
                                                        placeholder='0' readonly>
                                                </td>
                                            </tr>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade" id="custom-content-above-client" role="tabpanel" aria-labelledby="custom-content-above-client-tab">
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="card-description text-info">--- {{ __('Situation Client') }} ---</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{ __('Solde Actuel') }} :</label>
                                        <?php
                                        if( isset($listArrayInfGlob->AMOUNT) ){
                                        ?>
                                            <input type="number" step="any" class="form-control" value="{{ $listArrayInfGlob->AMOUNT }}" id="solde_comp" name="solde_compensation" readonly/>
                                        <?php
                                            }else{
                                        ?>
                                            <input type="number" step="any" class="form-control" value="0" id="solde_comp" name="solde_compensation" readonly/>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <?php
                                    if( isset($listArrayInfGlob->WORKING) ){
                                ?>
                                    <input type="hidden" class="form-control" name="working_balance" value="{{ $listArrayInfGlob->WORKING }}"/>
                                <?php
                                    }else{
                                ?>
                                    <input type="hidden" class="form-control" name="working_balance" value="0"/>
                                <?php
                                    }
                                ?>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{ __('Compensation') }} :</label>
                                        <input type="number"  step="any" class="form-control" id="compensation_val" name="compensation_val" readonly/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{ __('Nouveau solde aprés compensation') }} :</label>
                                        <input type="text" step="any" name="solde_apres" class="form-control" id="solde_apres" placeholder='0' disabled/>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label> {{ __('Classement du client chez la banque')}} :</label>
                                        @if ($listArrayInfGlob->CLASSEMENT == 0)
                                            <input type="text" class="form-control" id="classement_client" name="classement_client" value="CREANCES COURANTES - 0" readonly/>
                                        @elseif ($listArrayInfGlob->CLASSEMENT == 1)
                                            <input type="text" class="form-control" id="classement_client" name="classement_client" value="CREANCES NECESSITANT UN SUIVI PARTICULIER - 1" readonly/>
                                        @elseif ($listArrayInfGlob->CLASSEMENT == 2)
                                            <input type="text" class="form-control" id="classement_client" name="classement_client" value="CREANCES INCERTAINTES - 2" readonly/>
                                        @elseif ($listArrayInfGlob->CLASSEMENT == 3)
                                            <input type="text" class="form-control" id="classement_client" name="classement_client" value="CREANCES PREOCCUPANTES - 3" readonly/>
                                        @elseif ($listArrayInfGlob->CLASSEMENT == 4)
                                            <input type="text" class="form-control" id="classement_client" name="classement_client" value="CREANCES COMPROMESES - 4" readonly/>
                                        @elseif ($listArrayInfGlob->CLASSEMENT == 5)
                                            <input type="text" class="form-control" id="classement_client" name="classement_client" value="CREANCES AU CONTENTIEUX - 5" readonly/>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            @endif
                            @endforeach


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5 class="card-description text-info">--- {{ __('Impayé à payer') }} ---</h5>
                                        <div class="table-responsive">
                                            <table class="table" id="tab_impaye">
                                                <thead>
                                                    <th>Nature</th>
                                                    <th>Montant</th>
                                                    <th>Devise</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <tr id='impaye0'></tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="10"></td>
                                                        <td>
                                                            <a id="add_row_impaye" class="btn btn-info"><i
                                                                    class="fa fa-plus"></i></a>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h5 class="card-description text-info">--- {{ __('Encours chèque') }} ---</h5>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <th>{{ __('Référence') }}</th>
                                                    <th>{{ __('Montant') }}</th>
                                                    <th>{{ __('Devise') }}</th>
                                                    <th>{{ __('Num Bord') }}</th>
                                                    <th>{{ __('Date d\'encaissement') }}</th>
                                                </thead>
                                                <tbody>
                                                    @if ((count($listArrayENCR)>0))
                                                    <?php
                                                        if(isset($listArrayENCR[0])){
                                                    ?>
                                                    @foreach ($listArrayENCR as $listArrayENCR)
                                                    <tr>
                                                        <input type="hidden" name="encours_compensation" value="notEmty">
                                                        <td><input class="form-control" name="referenceEnc[]" value="{{ $listArrayENCR->REFERENCE }}" readonly></td>
                                                        <?php
                                                    if(isset($listArrayENCR->AMOUNT)){
                                                ?>
                                                    <td><input class="form-control" name="montantEnc[]" value="{{ $listArrayENCR->AMOUNT }}" readonly></td>
                                                <?php
                                                    }else{
                                                ?>
                                                    <td><input class="form-control" name="montantEnc[]" value=" " readonly></td>
                                                <?php
                                                    }
                                                ?>
                                                            <?php
                                                            if(isset($listArrayENCR->CURRENCY)){
                                                            ?>
                                                                <td><input class="form-control" name="deviseEnc[]" value="{{ $listArrayENCR->CURRENCY }}" readonly></td>
                                                            <?php
                                                                }else{
                                                            ?>
                                                                <td><input class="form-control" name="deviseEnc[]" value=" " readonly></td>
                                                            <?php
                                                                }
                                                            ?>
                                                            <?php
                                                            if(isset($listArrayENCR->NUMBORD)){
                                                            ?>
                                                                <td><input class="form-control" name="numbord[]" value="{{ $listArrayENCR->NUMBORD }}" readonly></td>
                                                            <?php
                                                                }else{
                                                            ?>
                                                                <td><input class="form-control" name="numbord[]" value=" " readonly></td>
                                                            <?php
                                                                }
                                                            ?>
                                                        <td><?php   $dateConvertEC = strtotime($listArrayENCR->DATEENCAISS);
                                                            $dateFinaleEC = date("d/m/Y",$dateConvertEC);
                                                            $datef = $dateFinaleEC ?><input class="form-control" name="dateEnc[]" value="{{ $datef }}" readonly>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <?php
                                                    }else{
                                                    ?>
                                                        <tr>
                                                            <td><input class="form-control" name="referenceEnc" value="{{ $listArrayENCR['REFERENCE'] }}" readonly></td>
                                                            <?php
                                                    if(isset($listArrayENCR['AMOUNT'])){
                                                        ?>
                                                            <td><input class="form-control" name="montantEnc" value="{{ $listArrayENCR['AMOUNT'] }}" readonly></td>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <td><input class="form-control" name="montantEnc" value=" " readonly></td>
                                                        <?php
                                                            }
                                                        ?>
                                                                <?php
                                                                if(isset($listArrayENCR['CURRENCY'])){
                                                                ?>
                                                                    <td><input class="form-control" name="deviseEnc" value="{{ $listArrayENCR['CURRENCY'] }}" readonly></td>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <td><input class="form-control" name="deviseEnc" value=" " readonly></td>
                                                                <?php
                                                                    }
                                                                ?>
                                                                <?php
                                                                if(isset($listArrayENCR['NUMBORD'])){
                                                                ?>
                                                                        <td><input class="form-control" name="numbord" value="{{ $listArrayENCR['NUMBORD'] }}" readonly></td>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <td><input class="form-control" name="numbord" value=" " readonly></td>
                                                                <?php
                                                                    }
                                                                ?>
                                                            <td><?php   $dateConvertEC = strtotime($listArrayENCR['DATEENCAISS']);
                                                                $dateFinaleEC = date("d/m/Y",$dateConvertEC);
                                                                $datef = $dateFinaleEC ?><input class="form-control" name="dateEnc" value="{{ $datef }}" readonly>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        }
                                                    ?>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <h5 class="card-description text-info">
                                --- {{ __('Encours effet à l\'encaissement') }} ---
                            </h5>
                            <hr>
                            <div class="form-group">
                                <div class="table-responsive">
                                    <table class="table ">
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
                                            @if ((count($listArrayEFFET)>0))
                                            <?php
                                                if(isset($listArrayEFFET[0])){
                                            ?>
                                            @foreach ($listArrayEFFET as $listArrayEFFET)
                                                @if ($listArrayEFFET->STATUT == 4)
                                                    <tr>
                                                        <input type="hidden" name="encours_effet" value="notempty">
                                                        <td><input class="form-control" name="cfuEncours[]" value="{{ $listArrayEFFET->ID }}" readonly></td>
                                                        <td><input class="form-control" name="numEffetEncours[]" value="{{ $listArrayEFFET->NUMEFFET }}" readonly></td>
                                                        <td><input class="form-control" name="nomTireEffet[]" value="{{ $listArrayEFFET->NOMTIRE }}" readonly></td>
                                                        <td><input class="form-control" name="ribTireEffet[]" value="{{ $listArrayEFFET->RIBTIRE }}" readonly></td>
                                                        <td><input class="form-control" name="montantEffet[]" value="{{ $listArrayEFFET->MONTANTPRINCIPAL }}" readonly></td>
                                                        <td>
                                                            <?php
                                                                $dateConvertimp = strtotime($listArrayEFFET->DATEECHEANCE);
                                                                $DATEECHEANCE = date("d/m/Y",$dateConvertimp);
                                                            ?>
                                                            <input class="form-control" name="dateEcheanceEffet[]" value="{{ $DATEECHEANCE }}" readonly>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $dateConvertimp = strtotime($listArrayEFFET->DATEREMISE);
                                                                $DATEREMISE = date("d/m/Y",$dateConvertimp);
                                                            ?>
                                                            <input class="form-control" name="dateRemiseEffet[]" value="{{ $DATEREMISE }}" readonly>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                            <?php
                                                }else{
                                            ?>

                                            @if ($listArrayEFFET['STATUT'] == 4)
                                                <tr>
                                                    <td><input class="form-control" name="cfuEncours" value="{{ $listArrayEFFET['ID'] }}" readonly></td>
                                                    <td><input class="form-control" name="numEffetEncours" value="{{ $listArrayEFFET['NUMEFFET'] }}" readonly></td>
                                                    <td><input class="form-control" name="nomTireEffet" value="{{ $listArrayEFFET['NOMTIRE'] }}" readonly></td>
                                                    <td><input class="form-control" name="ribTireEffet" value="{{ $listArrayEFFET['RIBTIRE'] }}" readonly></td>
                                                    <td><input class="form-control" name="montantEffet" value="{{ $listArrayEFFET['MONTANTPRINCIPAL'] }}" readonly></td>
                                                    <td>
                                                        <?php   $dateConvertimp = strtotime($listArrayEFFET['DATEECHEANCE']);
                                                            $DATEECHEANCE = date("d/m/Y",$dateConvertimp);
                                                        ?>
                                                        <input class="form-control" name="dateEcheanceEffet" value="{{ $DATEECHEANCE}}" readonly>
                                                    </td>
                                                    <td>
                                                        <?php   $dateConvertimp = strtotime($listArrayEFFET['DATEREMISE']);
                                                            $DATEREMISE = date("d/m/Y",$dateConvertimp);
                                                        ?>
                                                        <input class="form-control" name="dateRemiseEffet" value="{{ $DATEREMISE}}" readonly>
                                                    </td>
                                                </tr>
                                            @endif

                                            <?php
                                                }
                                            ?>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <br>
                            <h5 class="card-description text-info">--- {{ __('Couverture') }} ---</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Effet à l\'escompte Encours d\'étude') }} :</label>
                                        <input type="number" step="any" name="encaissement_effet_etude" class="form-control "  />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Effet à l\'escompte Encours de validation') }} :</label>
                                        <input type="number" step="any" name="encaissement_effet" class="form-control "  />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Versement Espèces') }} :</label>
                                        <input type="number" step="any" name="versement" class="form-control "/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('Note Couverture') }} :</label>
                                        <textarea type="text" name="note_couverture" class="form-control "></textarea>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <h5 class="card-description text-info">--- {{ __('Chiffre d\'affaire Confié') }} ---</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span class="text-danger">*</span>{{ __('L\'année précédente') }} :</label>
                                        <input type="number" step="any" name="chiffre_ans_preced" id="chiffre_ans_preced" class="form-control "  required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span class="text-danger">*</span>{{ __('Cette année') }} :</label>
                                        <input type="number" step="any" name="chiffre_ans_encours" id="chiffre_ans_encours" class="form-control "  required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="card-description text-info">--- {{ __('Situation Client') }} ---</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-4">
                                            <label><span class="text-danger">*</span>{{ __('Interdit de chéquier ?') }}</label>
                                            <div class="form-group">
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="interdit_chq_client" id="interdit_chq_client_oui" value="oui" required>
                                                    <label class="form-check-label radio-inline">{{ __('Oui') }}</label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="interdit_chq_client" id="interdit_chq_client_non" value="non">
                                                    <label class="form-check-label">{{ __('Non') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                        <label>{{ __('Date d\'interdiction') }} :</label>
                                        <div class="form-group">
                                            <input type="text" name="interdit_chq_client_date" id="interdit_chq_client_date" placeholder="jj/mm/AAAA" class="form-control " disabled/>
                                        </div>
                                        </div>
                                        <div class="col-4">
                                        <label>{{ __('Nombre') }} :</label>
                                        <div class="form-group">
                                            <input type="number" name="interdit_chq_client_nombre" id="interdit_chq_client_nombre" class="form-control " disabled/>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span class="text-danger">*</span>{{ __('Classement Client sur le SED') }}</label>
                                        <div class="custom-file">
                                            <input type="file" name="engagement_client" class="custom-file-input" id="engagement_client" accept=".pdf" required>
                                            <label class="custom-file-label" for="engagement_client"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label><span class="text-danger">*</span>{{ __('Impayé dans le secteur ?') }}</label>
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="montant_non_paye" id="montant_non_paye_oui" value="oui" required>
                                            <label class="form-check-label">{{ __('Oui') }}</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="montant_non_paye" id="montant_non_paye_non" value="non">
                                            <label class="form-check-label">{{ __('Non') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label><span class="text-danger">*</span>{{ __('Risque Client sur le SED') }}</label>
                                    <div class="custom-file">
                                        <input type="file" name="risque_client" class="custom-file-input" accept=".pdf" id="risque_client" required>
                                        <label class="custom-file-label" for="risque_client"></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label><span class="text-danger">*</span>{{ __('Dépassement sur les engagements ?') }}</label>
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="depassement" id="depassement_oui" value="oui" required>
                                            <label class="form-check-label">{{ __('Oui') }}</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="depassement" id="depassement_non" value="non">
                                            <label class="form-check-label">{{ __('Non') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Garanties') }} :</label>
                                        <div class="custom-file">
                                            <input type="file" name="garantie" class="custom-file-input" accept=".pdf" id="garantie">
                                            <label class="custom-file-label" for="garantie"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                    <div class="col-4">
                                        <label><span class="text-danger">*</span>{{ __('Etat Financier fournie ?') }} </label>
                                        <div class="form-group">
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="radio" name="liste_finance_final" id="liste_finance_final_oui" value="oui" required>
                                                <label class="form-check-label">{{ __('Oui') }}</label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="radio" name="liste_finance_final" id="liste_finance_final_non" value="non">
                                                <label class="form-check-label">{{ __('Non') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label>{{ __('Année') }} :</label>
                                        <div class="form-group">
                                            <input type="number" name="annee_etat_financier" id="annee_etat_financier" class="form-control " disabled />
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label>{{ __('Type') }} :</label>
                                        <div class="form-group">
                                            <select class="form-control" name="type_etat_financier" id="type_etat_financier" disabled>
                                                <option value="_"> </option>
                                                <option value="provisoire">Provisoire</option>
                                                <option value="certifié">Certifié</option>
                                                <option value="définitif">Définitif</option>
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--<div class="form-group">
                                        <label>{{ __('Autorisation') }} :</label>
                                        <input type="number" step="any" name="ligne_fournie" class="form-control " />
                                    </div> -->
                                </div>


                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-4">
                                            <label><span class="text-danger">*</span>{{ __('Rapport commissaire au compte ?') }}</label>
                                            <div class="form-group">
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="liste_finance_rapport" id="liste_finance_rapport_oui" value="oui" required>
                                                    <label class="form-check-label">{{ __('Oui') }}</label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="liste_finance_rapport" id="liste_finance_rapport_non" value="non">
                                                    <label class="form-check-label">{{ __('Non') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label>{{ __('Année') }} :</label>
                                            <div class="form-group">
                                                <input type="number" name="anneecommissaire" id="anneecommissaire" class="form-control " disabled/>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label>{{ __('Réserve') }} :</label>
                                            <div class="form-group">
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="liste_finance_rapport_reserve" id="liste_finance_rapport_reserve_oui" value="oui">
                                                    <label class="form-check-label">{{ __('Oui') }}</label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="liste_finance_rapport_reserve" id="liste_finance_rapport_reserve_non" value="non">
                                                    <label class="form-check-label">{{ __('Non') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{ __('Chiffre d\'affaire global N') }} </label>
                                                <input type="number" step="any" name="nb_transaction" class="form-control "  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{ __('Resultat net N') }} </label>
                                                <input type="number" step="any" name="resultat_brut" class="form-control "  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{ __('Chiffre d\'affaire global N-1') }} </label>
                                                <input type="number" step="any" name="chiffre_n" class="form-control "  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{ __('Resultat net N-1') }} </label>
                                                <input type="number" step="any" name="resultat_n" class="form-control "  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <h5 class="card-description text-info">--- {{ __('Les tombés d\'échéance (Dans 2 semaines)') }}---</h5>
                            <hr>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-12">
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <th>{{ __('Référence') }}</th>
                                                    <th>{{ __('Nature') }}</th>
                                                    <th>{{ __('Montant') }}</th>
                                                    <th>{{ __('Devise') }}</th>
                                                    <th>{{ __('Date d\'écheance') }}</th>
                                                    <th>{{ __('Date proche') }}</th>
                                                </thead>
                                                <tbody>
                                                    @if (count($listArrayTMBE)>0)
                                                        <?php
                                                            if(isset($listArrayTMBE[0])){
                                                        ?>
                                                        @foreach ($listArrayTMBE as $listArrayTMBE)
                                                        <tr>
                                                            <input type="hidden" name="tombe_compensation" value="notEmty">
                                                            <td><input class="form-control" name="referenceTombe[]" value="{{ $listArrayTMBE->ENGAGEMENT }}" readonly></td>
                                                            <?php
                                                            if( isset($listArrayTMBE->LIBELLECREDIT) ){
                                                        ?>
                                                            <td><input class="form-control" name="natureTombe[]" value="{{ $listArrayTMBE->LIBELLECREDIT }}" readonly></td>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <td><input class="form-control" name="natureTombe[]" value=" " readonly></td>
                                                        <?php
                                                            }
                                                        ?>
                                                            <td><input class="form-control" name="montantTombe[]" value="{{ $listArrayTMBE->ENCOURS }}" readonly></td>
                                                            <td><input class="form-control" name="deviseTombe[]" value="{{ $listArrayTMBE->CURRENCY }}" readonly></td>
                                                            <td><?php   $dateConvertDE = strtotime($listArrayTMBE->ECHEDATE);
                                                                $dateFinaleDE = date("d/m/Y",$dateConvertDE);
                                                                $dfDE = $dateFinaleDE ?><input class="form-control" name="date_echTombe[]" value="{{ $dfDE }}" readonly>
                                                            </td>
                                                            <?php
                                                                if( isset($listArrayTMBE->DATEPROCH) ){
                                                                $dateConvertDP = strtotime($listArrayTMBE->DATEPROCH);
                                                                $dateFinaleDP = date("d/m/Y",$dateConvertDP);
                                                                $dfDP = $dateFinaleDP ?>
                                                                    <td><input class="form-control" name="date_procheTombe[]" value="{{ $dfDP }}" readonly></td>
                                                            <?php
                                                                    }else{
                                                                ?>
                                                                    <td><input class="form-control" name="date_procheTombe[]" value=" " readonly></td>
                                                                <?php
                                                                    }
                                                                ?>
                                                            <input type="hidden" name="categoryTombe[]" value="{{ $listArrayTMBE->CATEGORY }}">
                                                        </tr>
                                                        @endforeach

                                                        <?php }else{
                                                        ?>
                                                        <tr>
                                                            <td><input class="form-control" name="referenceTombe" value="{{ $listArrayTMBE['ENGAGEMENT'] }}" readonly></td>
                                                            <?php
if( isset($listArrayTMBE['LIBELLECREDIT']) ){
?>
<td><input class="form-control" name="natureTombe" value="{{ $listArrayTMBE['LIBELLECREDIT'] }}" readonly></td>
<?php
}else{
?>
<td><input class="form-control" name="natureTombe" value=" " readonly></td>
<?php
}
?>
                                                            <td><input class="form-control" name="montantTombe" value="{{ $listArrayTMBE['ENCOURS'] }}" readonly></td>
                                                            <td><input class="form-control" name="deviseTombe" value="{{ $listArrayTMBE['CURRENCY'] }}" readonly></td>
                                                            <td><?php   $dateConvertDE = strtotime($listArrayTMBE['ECHEDATE']);
                                                                $dateFinaleDE = date("d/m/Y",$dateConvertDE);
                                                                $dfDE = $dateFinaleDE ?><input class="form-control" name="date_echTombe" value="{{ $dfDE }}" readonly>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if( isset($listArrayTMBE['DATEPROCH']) ){
                                                                    $dateConvertDP = strtotime($listArrayTMBE['DATEPROCH']);
                                                                    $dateFinaleDP = date("d/m/Y",$dateConvertDP);
                                                                    $dfDP = $dateFinaleDP
                                                                ?>
                                                                    <input class="form-control" name="date_procheTombe" value="{{ $dfDP }}" readonly>
                                                                <?php }else{ ?>
                                                                    <input class="form-control" name="date_procheTombe" value=" " readonly>
                                                                <?php } ?>
                                                            </td>
                                                            <input type="hidden" name="categoryTombe" value="{{ $listArrayTMBE['CATEGORY'] }}">
                                                        </tr>
                                                        <?php } ?>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

        <?php
            }else{
        ?>

        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
            <br>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{ __('Agence') }} :</label>
                        <input type="hidden" name="code_agence" value="{{ Auth::user()->agence_id }}"/>
                        @if (Auth::user()->agence_id == 1)
                        <input type="text" class="form-control" value="BTL agence de Tunis" readonly/>
                        @elseif (Auth::user()->agence_id == 3)
                        <input type="text" class="form-control" value="BTL agence de Sfax" readonly/>
                        @elseif (Auth::user()->agence_id == 4)
                        <input type="text" class="form-control" value="BTL agence de Nabeul" readonly/>
                        @elseif (Auth::user()->agence_id == 5)
                        <input type="text" class="form-control" value="BTL agence de Petite Ariana" readonly/>
                        @elseif (Auth::user()->agence_id == 6)
                        <input type="text" class="form-control" value="BTL agence de Ben Arous" readonly/>
                        @elseif (Auth::user()->agence_id == 7)
                        <input type="text" class="form-control" value="BTL agence de Den Den" readonly/>
                        @elseif (Auth::user()->agence_id == 8)
                        <input type="text" class="form-control" value="BTL agence de Sousse" readonly/>
                        @elseif (Auth::user()->agence_id == 9)
                        <input type="text" class="form-control" value="BTL agence de Gabes" readonly/>
                        @elseif (Auth::user()->agence_id == 11)
                        <input type="text" class="form-control" value="BTL agence de Sfax ELBOSTENE" readonly/>
                        @elseif (Auth::user()->agence_id == 12)
                        <input type="text" class="form-control" value="BTL agence de Bizerte" readonly/>
                        @elseif (Auth::user()->agence_id == 13)
                        <input type="text" class="form-control" value="BTL agence de Nabeul 2" readonly/>
                        @elseif (Auth::user()->agence_id == 14)
                        <input type="text" class="form-control" value="BTL agence de Mednine" readonly/>
                        @elseif (Auth::user()->agence_id == 15)
                        <input type="text" class="form-control" value="BTL agence de Monastir" readonly/>
                        @elseif (Auth::user()->agence_id == 16)
                        <input type="text" class="form-control" value="BTL agence de Centre Urbain Nord" readonly/>
                        @elseif (Auth::user()->agence_id == 17)
                        <input type="text" class="form-control" value="BTL agence de Enasr" readonly/>
                        @elseif (Auth::user()->agence_id == 18)
                        <input type="text" class="form-control" value="BTL agence de Ariana" readonly/>
                        @elseif (Auth::user()->agence_id == 19)
                        <input type="text" class="form-control" value="BTL agence de Lac 2" readonly/>
                        @elseif (Auth::user()->agence_id == 20)
                        <input type="text" class="form-control" value="BTL agence de Aouina" readonly/>
                        @elseif (Auth::user()->agence_id == 24)
                        <input type="text" class="form-control" value="BTL agence de Megrine" readonly/>
                        @endif
                    </div>
                <!-- /.form-group -->
                </div>
                <div class="col-md-3">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->name }}"/>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="date">{{ __('Date') }} :</label>
                        <input type="date" class="form-control input-sm" id="dateSys" name="date_compensation" readonly>
                    </div>
                    <!-- /.form-group -->
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{ __('Code Client') }} :</label>
                        <input type="number" class="form-control " name="code_client" id="code_client" value="{{ $listArrayInfGlob['ID'] }}" readonly/>
                        <input type="hidden" class="form-control " name="account_number" value="{{ $listArrayInfGlob['ACCOUNT'] }}" readonly/>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{ __('Client') }} :</label>
                        <input type="text" class="form-control" name="nom_client" id="nom_client" value="{{ $listArrayInfGlob['SHORTNAME'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>{{ __('Date d\'ouverture du compte') }} :</label>
                        <input type="text" class="form-control input-sm" name="date_ouverture_new"
                        value="<?php    $dateConvertOu = strtotime($listArrayInfGlob['CONTACTDATE']);
                                        $dateFinaleOu = date("d/m/Y",$dateConvertOu);
                                        echo $dateFinaleOu
                                ?>" readonly>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>{{ __('Activité du société') }} :</label>
                        <input type="text" class="form-control" name="domaine_societe" value="{{ $listArrayInfGlob['LIBINDUSTRY'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>{{ __('Secteur') }} :</label>
                        @if (($listArrayInfGlob['SECTORCODE'] == 7000 )||($listArrayInfGlob['SECTORCODE'] == 7100 ))
                            <input type="hidden" class="form-control" name="secteur_client" value="particulier" readonly/>
                            <input type="text" class="form-control" name="name_secteur" value="{{ $listArrayInfGlob['DESCRIPTION'] }}" readonly/>
                        @else
                            <input type="hidden" class="form-control" name="secteur_client" value="corporate" readonly/>
                            <input type="text" class="form-control" name="name_secteur" value="{{ $listArrayInfGlob['DESCRIPTION'] }}" readonly/>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Identifiant Bénéficiaire Effectif') }}:</label>
                        <?php
                            if(isset($listArrayInfGlob['IDBENEFICIAIRE'])){
                        ?>
                        <input type="text" class="form-control " name="id_benef" value="{{ $listArrayInfGlob['IDBENEFICIAIRE'] }}" readonly/>
                        <?php
                            }else{
                        ?>
                        <input type="text" class="form-control " name="id_benef" value=" " readonly/>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Bénéficiaire Effectif') }}:</label>
                        <?php
                            if(isset($listArrayInfGlob['BENEFICIAIRE'])){
                        ?>
                        <input type="text" class="form-control " name="beneficiare" id="beneficiare" value="{{ $listArrayInfGlob['BENEFICIAIRE'] }}" readonly/>
                        <?php
                            }else{
                        ?>
                        <input type="text" class="form-control " name="beneficiare" id="beneficiare" value=" " readonly/>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>

            <!--GERANT-->
            <br>
            <hr>
            <h5 class="card-description text-info">
                --- {{ __('Engagement du gérant avec la banque') }} ---
            </h5>
            <hr>
            <div class="table-responsive">
                <table class="table" id="tableGerant">
                    <thead>
                        <th>CODE</th>
                        <th>NAME</th>
                        <th>CLIENT</th>
                        <th>CLASSEMENT</th>
                        <th>ENGAGEMENT</th>
                        <th>LIBELLE</th>
                        <th>DATE ECHENACE</th>
                        <th>ENCOURS</th>
                        <th>CURRENCY</th>
                        <th>ENCOURS TND</th>
                    </thead>
                    <tbody>
                        @if ((count($listArrayEngGer)>0))

                            <?php
                                if(isset($listArrayEngGer[0])){
                            ?>
                                @foreach ($listArrayEngGer as $key => $listArrayEngGer)
                                <tr>
                                    <input type="hidden" name="engagement_store" value="notEmpty">
                                    <td><input class="form-control" name="code_gerant[]" value="{{ $listArrayEngGer->SIGNATORY }}" readonly></td>
                                    <td><input class="form-control" name="nom_gerant[]" value="{{ $listArrayEngGer->SIGNATORYNAME }}" readonly></td>
                                    <td><input class="form-control" name="client[]" value="{{ $listArrayEngGer->CLIENTBANQUE }}" readonly></td>
                                    @if (isset($listArrayEngGer->CLASSEMENT)&&($listArrayEngGer->CLASSEMENT == 0))
                                        <td><input type="text" class="form-control" name="classementEng[]" value="CREANCES COURANTES - 0" readonly/></td>
                                    @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer->CLASSEMENT == 1)
                                        <td><input type="text" class="form-control" name="classementEng[]" value="CREANCES NECESSITANT UN SUIVI PARTICULIER - 1" readonly/></td>
                                    @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer->CLASSEMENT == 2)
                                        <td><input type="text" class="form-control" name="classementEng[]" value="CREANCES INCERTAINTES - 2" readonly/></td>
                                    @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer->CLASSEMENT == 3)
                                        <td><input type="text" class="form-control" name="classementEng[]" value="CREANCES PREOCCUPANTES - 3" readonly/></td>
                                    @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer->CLASSEMENT == 4)
                                        <td><input type="text" class="form-control" name="classementEng[]" value="CREANCES COMPROMESES - 4" readonly/></td>
                                    @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer->CLASSEMENT == 5)
                                        <td><input type="text" class="form-control" name="classementEng[]" value="CREANCES AU CONTENTIEUX - 5" readonly/></td>
                                    @endif
                                    <?php
                                    if(isset($listArrayEngGer->ENGAGEMENT)){
                                    ?>
                                    <td><input class="form-control" name="engagement[]" value="{{ $listArrayEngGer->ENGAGEMENT }}" readonly></td>
                                    <td><input class="form-control" name="type_eng_gerant[]" value="{{ $listArrayEngGer->LIBELLE }}" readonly></td>
                                    <td><input class="form-control" name="date_eng_gerant[]" value="{{ $listArrayEngGer->ECHEDATE }}" readonly></td>
                                    <td><input class="form-control" name="montant_eng_gerant[]" value="{{ $listArrayEngGer->ENCOURS }}" readonly></td>
                                    <td><input class="form-control" name="devise[]" value="{{ $listArrayEngGer->CURRENCY }}" readonly></td>
                                    <td><input class="form-control" name="encours_tnd[]" value="{{ $listArrayEngGer->ENCOURSTND }}" readonly></td>


                                    <?php
                                    }else{
                                    ?>

                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>

                                    <?php
                                    }
                                    ?>

                                </tr>
                                @endforeach
                            <?php
                                }else{
                            ?>
                                <tr>
                                    <td><input class="form-control" name="code_gerant" value="{{ $listArrayEngGer['SIGNATORY'] }}" readonly></td>
                                    <td><input class="form-control" name="nom_gerant" value="{{ $listArrayEngGer['SIGNATORYNAME'] }}" readonly></td>
                                    <td><input class="form-control" name="client" value="{{ $listArrayEngGer['CLIENTBANQUE'] }}" readonly></td>
                                    @if (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer['CLASSEMENT'] == 0)
                                        <td><input type="text" class="form-control" name="classementEng" value="CREANCES COURANTES - 0" readonly/></td>
                                    @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer['CLASSEMENT'] == 1)
                                        <td><input type="text" class="form-control" name="classementEng" value="CREANCES NECESSITANT UN SUIVI PARTICULIER - 1" readonly/></td>
                                    @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer['CLASSEMENT'] == 2)
                                        <td><input type="text" class="form-control" name="classementEng" value="CREANCES INCERTAINTES - 2" readonly/></td>
                                    @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer['CLASSEMENT'] == 3)
                                        <td><input type="text" class="form-control" name="classementEng" value="CREANCES PREOCCUPANTES - 3" readonly/></td>
                                    @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer['CLASSEMENT'] == 4)
                                        <td><input type="text" class="form-control" name="classementEng" value="CREANCES COMPROMESES - 4" readonly/></td>
                                    @elseif (isset($listArrayEngGer->CLASSEMENT)&&$listArrayEngGer['CLASSEMENT'] == 5)
                                        <td><input type="text" class="form-control" name="classementEng" value="CREANCES AU CONTENTIEUX - 5" readonly/></td>
                                    @endif
                                    <?php
                                    if(isset($listArrayEngGer['ENGAGEMENT'])){
                                    ?>
                                    <td><input class="form-control" name="engagement" value="{{ $listArrayEngGer['ENGAGEMENT'] }}" readonly></td>
                                    <td><input class="form-control" name="type_eng_gerant" value="{{ $listArrayEngGer['LIBELLE'] }}" readonly></td>
                                    <td><input class="form-control" name="date_eng_gerant" value="{{ $listArrayEngGer['ECHEDATE'] }}" readonly></td>
                                    <td><input class="form-control" name="montant_eng_gerant" value="{{ $listArrayEngGer['ENCOURS'] }}" readonly></td>

                                    <td><input class="form-control" name="devise" value="{{ $listArrayEngGer['CURRENCY'] }}" readonly></td>
                                    <td><input class="form-control" name="encours_tnd" value="{{ $listArrayEngGer['ENCOURSTND'] }}" readonly></td>

                                    <?php
                                    }else{
                                    ?>

                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            <?php
                                }
                            ?>
                        @endif
                    </tbody>
                </table>
            </div>
            <br>
            <h5 class="card-description text-info">
                --- {{ __('Engagement du gérant sur le SED') }} ---
            </h5>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ __('Crédit au particulier') }} :</label>
                        <div class="custom-file">
                            <input type="file" name="credit_particulier_gerant" class="custom-file-input" id="credit_particulier_gerant" accept=".pdf" disabled>
                            <label class="custom-file-label" for="credit_particulier_gerant"></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ __('Classement') }} :</label>
                        <div class="custom-file">
                            <input type="file" name="classement_gerant" class="custom-file-input" id="classement_gerant" accept=".pdf" disabled>
                            <label class="custom-file-label" for="classement_gerant"></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ __('Chèque impayé') }} :</label>
                        <div class="custom-file">
                            <input type="file" name="cheque_impaye_gerant" class="custom-file-input" id="cheque_impaye_gerant" accept=".pdf" disabled>
                            <label class="custom-file-label" for="cheque_impaye_gerant"></label>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <!--GERANT-->
        </div>

        <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Devise de compensation') }} :</label>
                        <input type="text" class="form-control " name="devise_compensation" value="TND" readonly/>
                    </div>
                </div>
            </div>

            <br>
            <h5 class="card-description text-info">
                --- {{ __('Placement') }} ---
            </h5>
            <hr>
            <div class="table-responsive">
                <table class="table" id="placement_table">
                    <thead>
                        <th>Référence</th>
                        <th>Nature du placement</th>
                        <th>Montant</th>
                        <th>Devise</th>
                        <th>Du</th>
                        <th>Jusqu'au</th>
                        <th>Taux du placement</th>
                        <th>Base TMM</th>
                        <th>Marge Variable</th>
                    </thead>
                    <tbody>
                        @if ((count($listArrayPlacement)>0))
                            <?php
                                if(isset($listArrayPlacement[0])){
                            ?>
                                @foreach ($listArrayPlacement as $key => $listArrayPlacement)
                                <tr>
                                        <input type="hidden" name="placement_compensation" value="notEmty">
                                    <td><input class="form-control" name="referenceP[]" value="{{ $listArrayPlacement->ID }}" readonly></td>
                                    <td><input class="form-control" name="natureP[]" value="{{ $listArrayPlacement->LCATEGORY }}" readonly></td>
                                    <td><input class="form-control" name="montantP[]" value="{{ $listArrayPlacement->AMOUNT }}" readonly></td>
                                    <td><input class="form-control" name="deviseP[]" value="{{ $listArrayPlacement->CURRENCY }}" readonly></td>
                                    <td><input class="form-control" name="du[]" value="{{ $listArrayPlacement->VALUEDATE }}" readonly></td>
                                    <td><input class="form-control" name="au[]" value="{{ $listArrayPlacement->FINMATDATE }}" readonly></td>
                                    <td><input class="form-control" name="taux[]" value="{{ $listArrayPlacement->INTERESTRATE }}" readonly></td>

                                    <?php
                                    if(isset($listArrayPlacement->TMMTX)){
                                    ?>

                                    <td><input class="form-control" name="basetmm[]" value="{{ $listArrayPlacement->TMMTX }}" readonly></td>
                                    <td><input class="form-control" name="marge[]" value="{{ $listArrayPlacement->MARGETX }}" readonly></td>

                                    <?php
                                    }else{
                                    ?>

                                    <td></td>
                                    <td></td>

                                    <?php
                                    }
                                    ?>

                                </tr>
                                @endforeach
                            <?php
                                }else{
                            ?>
                                <tr>
                                    <td><input class="form-control" name="referenceP" value="{{ $listArrayPlacement['ID'] }}" readonly></td>
                                    <td><input class="form-control" name="natureP" value="{{ $listArrayPlacement['LCATEGORY'] }}" readonly></td>
                                    <td><input class="form-control" name="montantP" value="{{ $listArrayPlacement['AMOUNT'] }}" readonly></td>
                                    <td><input class="form-control" name="deviseP" value="{{ $listArrayPlacement['CURRENCY'] }}" readonly></td>
                                    <td><input class="form-control" name="du" value="{{ $listArrayPlacement['VALUEDATE'] }}" readonly></td>
                                    <td><input class="form-control" name="au" value="{{ $listArrayPlacement['FINMATDATE'] }}" readonly></td>
                                    <td><input class="form-control" name="taux" value="{{ $listArrayPlacement['INTERESTRATE'] }}" readonly></td>
                                    <?php
                                    if(isset($listArrayPlacement['TMMTX'])){
                                    ?>
                                    <td><input class="form-control" name="basetmm" value="{{ $listArrayPlacement['TMMTX'] }}" readonly></td>
                                    <td><input class="form-control" name="marge" value="{{ $listArrayPlacement['MARGETX'] }}" readonly></td>

                                    <?php
                                    }else{
                                    ?>

                                    <td> </td>
                                    <td> </td>

                                    <?php
                                    }
                                    ?>
                                </tr>
                            <?php
                                }
                            ?>
                        @endif
                    </tbody>
                </table>
            </div>

            <br>
            <h5 class="card-description text-info">
                --- {{ __('Crédits') }} ---
            </h5>
            <hr>
            <div class="table-responsive">
                <table class="table" id="credit_client">
                    <thead>
                        <th>Référence</th>
                        <th>Libellé</th>
                        <th>Category</th>
                        <th>Encours</th>
                        <th>Date Echéance</th>
                    </thead>
                    <tbody>
                        @if ((count($listArrayEngCred)>0))
                        <?php
                            if(isset($listArrayEngCred[0])){
                        ?>
                        @foreach ($listArrayEngCred as $listArrayEngCred)

                        <tr>
                            <?php
                                $limit = $listArrayEngCred->LIMITREFRENCE;
                                if((str_starts_with($limit,'5000'))||(str_starts_with($limit,'5100'))||(str_starts_with($limit,'5200'))||(str_starts_with($limit,'5300'))||(str_starts_with($limit,'5400'))||(str_starts_with($limit,'5500'))){
                            ?>
                            <input type="hidden" name="credit_compensation" value="notEmty">
                            <td><?php  $engagement = $listArrayEngCred->ENGAGEMENT  ?><input class="form-control" name="referenceCred[]" value="{{ $engagement }}" readonly></td>

                            <?php
                                if( isset($listArrayEngCred->LIBELLECREDIT) ){
                                $lib =  $listArrayEngCred->LIBELLECREDIT
                            ?>
                                <td><input class="form-control" name="libelleCred[]" value="{{ $lib }}" readonly></td>
                            <?php
                                }else{
                            ?>
                                <td><input class="form-control" name="libelleCred[]" value=" " readonly></td>
                            <?php
                                }
                            ?>

                            <td><?php $cat =  $listArrayEngCred->CATEGORY ?><input class="form-control" name="categoryCred[]" value="{{ $cat }}" readonly></td>
                            <td><?php $enc =  $listArrayEngCred->ENCOURS ?><input class="form-control" name="encoursCred[]" value="{{ $enc }}" readonly></td>
                            <td><?php   $dateConverti = strtotime($listArrayEngCred->ECHEDATE );
                                        $dateFinale = date("d/m/Y",$dateConverti);
                                        $datef =  $dateFinale ?><input class="form-control" name="dateCred[]" value="{{ $datef }}" readonly></td>
                            <?php
                                }
                            ?>
                        </tr>
                        @endforeach
                        <?php
                        }else{
                        ?>
                        <tr>
                            <?php
                                $limit = $listArrayEngCred['LIMITREFRENCE'];
                                if((str_starts_with($limit,'5000'))||(str_starts_with($limit,'5100'))||(str_starts_with($limit,'5200'))||(str_starts_with($limit,'5300'))||(str_starts_with($limit,'5400'))||(str_starts_with($limit,'5500'))){
                            ?>
                            <td><input class="form-control" name="referenceCred" value="{{ $listArrayEngCred['ENGAGEMENT'] }}" readonly></td>
                            <td><input class="form-control" name="libelleCred" value="{{ $listArrayEngCred['LIBELLECREDIT'] }}" readonly></td>
                            <td><input class="form-control" name="categoryCred" value="{{ $listArrayEngCred['CATEGORY'] }}" readonly></td>
                            <td><input class="form-control" name="encoursCred" value="{{ $listArrayEngCred['ENCOURS'] }}" readonly></td>
                            <td><?php   $dateConverti = strtotime($listArrayEngCred['ECHEDATE']);
                                $dateFinale = date("d/m/Y",$dateConverti);
                                $datef =   $dateFinale ?><input class="form-control" name="dateCred" value="{{ $datef }}" readonly>
                            </td>
                            <?php
                                }
                            ?>
                        </tr>
                        <?php
                        } ?>
                        @endif
                    </tbody>
                </table>
            </div>

            <br>
            <h5 class="card-description text-info">
                --- {{ __('Ligne de crédit de gestion') }} ---
            </h5>
            <hr>


            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                    <label>Autorisation :</label>
                    <?php
                        if(isset($first_line->PCOMM)){
                    ?>
                    <input type="number" step="any" class="form-control " id="autorisation_global" name="autorisation_global" value="{{ $first_line->PCOMM }}" readonly/>
                    <?php
                        }
                    ?>
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label>Utilisation :</label>
                    <?php
                        if(isset($first_line->POSAMT)){
                    ?>
                    <input type="number" step="any" class="form-control " name="utilisation_global" id="utilisation_global" value="{{ $first_line->POSAMT }}" readonly/>
                    <?php
                        }
                    ?>
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label>Disponible :</label>
                    <?php
                        if(isset($first_line->PAVAIL)){
                    ?>
                    <input type="number" step="any" class="form-control " name="disponible_global" id="disponible_global" value="{{ $first_line->PAVAIL }}" readonly/>
                    <?php
                        }
                    ?>
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{ __('Date d\'expiration') }} :</label>
                        <?php
                            if(isset($first_line->EXP)){
                        ?>
                        <input type="text" class="form-control input-sm"  name="date_global_new" value="{{ $first_line->EXP }}" readonly>
                        <?php
                            }
                        ?>
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
                    <label>Autorisation :</label>
                    <?php
                        if(isset($first_line->PCOMM)){
                    ?>
                    <input type="number" step="any" class="form-control " value="{{ $second_line->PCOMM }}" name="valeur_decision" id="valeur_decision" readonly/>
                    <?php
                        }
                    ?>
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label>Utilisation :</label>
                    <?php
                        if(isset($first_line->POSAMT)){
                    ?>
                    <input type="number" step="any" class="form-control " value="{{ $second_line->POSAMT }}" name="autorisation" id="autorisation_facilite" readonly/>
                    <?php
                        }
                    ?>
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label>Disponible :</label>
                    <?php
                        if(isset($first_line->PAVAIL)){
                    ?>
                    <input type="number" step="any" class="form-control " value="{{ $second_line->PAVAIL }}" name="disponible_autorisation" id="disponible_autorisation" readonly/>
                    <?php
                        }
                    ?>
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{ __('Date d\'expiration') }} :</label>
                        <?php
                            if(isset($first_line->EXP)){
                        ?>
                        <input type="text" class="form-control input-sm"  name="date_exp_decision_new" value="{{ $second_line->EXP }}" readonly>
                        <?php
                            }
                        ?>
                    </div>
                    <!-- /.form-group -->
                </div>
            </div>

            <br>
            <h5 class="card-description text-info">
                --- {{ __('Encours impayé client') }} ---
            </h5>
            <hr>
            <div class="form-group">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>{{ __('Référence') }}</th>
                            <th>{{ __('Type d\'impayé') }}</th>
                            <th>{{ __('Montant') }}</th>
                            <th>{{ __('Devise') }}</th>
                            <th>{{ __('Montant en TND') }}</th>
                            <th>{{ __('Date') }}</th>
                        </thead>
                        <tbody>
                            @if ((count($listArrayImp)>0))
                            <?php
                                if(isset($listArrayImp[0])){
                            ?>
                            @foreach ($listArrayImp as $listArrayImp)
                            <tr>
                                <input type="hidden" name="impaye_compensation" value="notempty">
                                <td><input class="form-control" name="refImp[]" value="{{ $listArrayImp->ID }}" readonly></td>
                                <td><input class="form-control" name="nature_besoinImp[]" value="{{ $listArrayImp->DESCRIPTION }}" readonly></td>
                                <td><input class="form-control" name="valeur_besoinImp[]" value="{{ $listArrayImp->TOTALAMTTOREPAY }}" readonly></td>
                                <td><input class="form-control" name="deviseImp[]" value="{{ $listArrayImp->CURRENCY }}" readonly></td>
                                <td><input class="form-control" name="mantant_tndImp[]" value="{{ $listArrayImp->TOTALAMTTOREPAYTND }}" readonly></td>
                                <td><?php   $dateConvertimp = strtotime($listArrayImp->PAYMENTDTEDUE);
                                    $dateFinaleimp = date("d/m/Y",$dateConvertimp);
                                ?>
                                <input class="form-control" name="echeance_besoinImp[]" value="{{ $dateFinaleimp }}" readonly>
                                </td>
                            </tr>
                            @endforeach

                                <?php }else{
                                    ?>
                                <tr>
                                    <td><input class="form-control" name="refImp" value="{{ $listArrayImp['ID'] }}" readonly></td>
                                    <td><input class="form-control" name="nature_besoinImp" value="{{ $listArrayImp['DESCRIPTION'] }}" readonly></td>
                                    <td><input class="form-control" name="valeur_besoinImp" value="{{ $listArrayImp['TOTALAMTTOREPAY'] }}" readonly></td>
                                    <td><input class="form-control" name="deviseImp" value="{{ $listArrayImp['CURRENCY'] }}" readonly></td>
                                    <td><input class="form-control" name="mantant_tndImp" value="{{ $listArrayImp['TOTALAMTTOREPAYTND'] }}" readonly></td>
                                    <td><?php   $dateConvertimp = strtotime($listArrayImp['PAYMENTDTEDUE']);
                                        $dateFinaleimp = date("d/m/Y",$dateConvertimp);
                                        ?><input class="form-control" name="echeance_besoinImp" value="{{ $dateFinaleimp}}" readonly>
                                    </td>
                                </tr>

                            <?php
                                }
                            ?>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <br>
            <h5 class="card-description text-info">
                --- {{ __('Impayés de Leasing - 3017') }} ---
            </h5>
            <hr>
            <div class="form-group">
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                            <th>{{ __('Num Compte') }}</th>
                            <th>{{ __('Solde') }}</th>
                            <th>{{ __('Devise') }}</th>
                            <th>{{ __('Date d\'ouverture') }}</th>
                        </thead>
                        <tbody>
                            @if ((count($listArrayLeas)>0))
                            <?php
                                if(isset($listArrayLeas[0])){
                            ?>
                            @foreach ($listArrayLeas as $listArrayLeas)
                            <tr>
                                <input type="hidden" name="impaye_compensation_leasing" value="notempty">
                                <td><input class="form-control" name="num_compte_ImpLeasing[]" value="{{ $listArrayLeas->ID }}" readonly></td>
                                <td><input class="form-control" name="solde_leasing[]" value="{{ $listArrayLeas->WORKINGBALANCE }}" readonly></td>
                                <td><input class="form-control" name="devise_leasing[]" value="{{ $listArrayLeas->CURRENCY }}" readonly></td>
                                <td>
                                    <?php
                                    $dateConvertimp = strtotime($listArrayLeas->OPENINGDATE);
                                    $dateFinaleimp = date("d/m/Y",$dateConvertimp);
                                    ?>
                                <input class="form-control" name="date_ouverture_leasing[]" value="{{ $dateFinaleimp }}" readonly>
                                </td>
                            </tr>
                            @endforeach

                                <?php }else{
                                    ?>
                                <tr>
                                    <td><input class="form-control" name="num_compte_ImpLeasing" value="{{ $listArrayLeas['ID'] }}" readonly></td>
                                    <td><input class="form-control" name="solde_leasing" value="{{ $listArrayLeas['WORKINGBALANCE'] }}" readonly></td>
                                    <td><input class="form-control" name="devise_leasing" value="{{ $listArrayLeas['CURRENCY'] }}" readonly></td>
                                    <td>
                                    <?php
                                        $dateConvertimp = strtotime($listArrayLeas['OPENINGDATE']);
                                        $dateFinaleimp = date("d/m/Y",$dateConvertimp);
                                        ?>
                                    <input class="form-control" name="date_ouverture_leasing" value="{{ $dateFinaleimp}}" readonly>
                                    </td>
                                </tr>

                            <?php
                                }
                            ?>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <br>
            <h5 class="card-description text-info">
                --- {{ __('Incident de paiement') }} ---
            </h5>
            <hr>
            <div class="form-group">
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                            <th>REF</th>
                            <th>NUM CHQ</th>
                            <th>CODE PRESENTATION</th>
                            <th>MONTANT</th>
                            <th>CURRENCY</th>
                            <th>DATE EMISSION</th>
                            <th>RIB BENEFICIAIRE</th>
                            <th>NOM BENEFICIAIRE</th>
                            <th>MOTIF REJET</th>
                        </thead>
                        <tbody>
                            @if ((count($listArrayIP)>0))
                            <?php
                                if(isset($listArrayIP[0])){
                            ?>
                            @foreach ($listArrayIP as $listArrayIP)
                                @if ($listArrayIP->DATEREGULE == 'EMPTY')
                                    <tr>
                                        <input type="hidden" name="incident_paiement" value="notempty">
                                        <td><input class="form-control" name="refIncident[]" value="{{ $listArrayIP->ID }}" readonly></td>
                                        <?php
                                            if(isset($listArrayIP->NUMCHQ)){
                                        ?>
                                            <td><input class="form-control" name="numChqIncident[]" value="{{ $listArrayIP->NUMCHQ }}" readonly></td>
                                        <?php
                                            }else{
                                        ?>
                                            <td><input class="form-control" name="numChqIncident[]" value=" " readonly></td>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                        if(isset($listArrayIP->CODEPRESENTATION)){
                                        ?>
                                            <td><input class="form-control" name="codeIncident[]" value="{{ $listArrayIP->CODEPRESENTATION }}" readonly></td>
                                        <?php
                                            }else{
                                        ?>
                                            <td><input class="form-control" name="codeIncident[]" value=" " readonly></td>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                        if(isset($listArrayIP->MONTANT)){
                                    ?>
                                        <td><input class="form-control" name="montantIncident[]" value="{{ $listArrayIP->MONTANT }}" readonly></td>
                                    <?php
                                        }else{
                                    ?>
                                        <td><input class="form-control" name="montantIncident[]" value=" " readonly></td>
                                    <?php
                                        }
                                    ?>
                                        <?php
                                        if(isset($listArrayIP->CURRENCY)){
                                    ?>
                                        <td><input class="form-control" name="currencyIncident[]" value="{{ $listArrayIP->CURRENCY }}" readonly></td>
                                    <?php
                                        }else{
                                    ?>
                                        <td><input class="form-control" name="currencyIncident[]" value=" " readonly></td>
                                    <?php
                                        }
                                    ?>
                                        <td>
                                            <?php
                                                if(isset($listArrayIP->DATEEMISSION)){
                                                    $dateConvertimp = strtotime($listArrayIP->DATEEMISSION);
                                                    $dateFinaleimp = date("d/m/Y",$dateConvertimp);
                                            ?>
                                                    <input class="form-control" name="dateIncident[]" value="{{ $dateFinaleimp }}" readonly>
                                            <?php
                                            }else{
                                            ?>
                                                    <input class="form-control" name="dateIncident[]" value=" " readonly>
                                            <?php
                                                }
                                            ?>
                                        </td>

                                        <?php
                                            if(isset($listArrayIP->RIBBENEF)){
                                        ?>
                                            <td><input class="form-control" name="ribIncident[]" value="{{ $listArrayIP->RIBBENEF }}" readonly></td>
                                        <?php
                                            }else{
                                        ?>
                                            <td><input class="form-control" name="ribIncident[]" value=" " readonly></td>
                                        <?php
                                            }

                                            if(isset($listArrayIP->NOMBENEF)){
                                        ?>
                                            <td><input class="form-control" name="nomBenefIncident[]" value="{{ $listArrayIP->NOMBENEF }}" readonly></td>
                                        <?php
                                            }else{
                                        ?>
                                            <td><input class="form-control" name="nomBenefIncident[]" readonly></td>
                                        <?php
                                            }
                                        ?>

                                        <?php
                                        if(isset($listArrayIP->MOTIFREJET)){
                                        ?>
                                        <td><input class="form-control" name="motifIncident[]" value="{{ $listArrayIP->MOTIFREJET }}" readonly></td>
                                        <?php
                                        }else{
                                        ?>
                                        <td><input class="form-control" name="motifIncident[]" value=" " readonly></td>
                                        <?php
                                        }
                                        ?>
                                        <input type="hidden" name="DATEREGULEIncident[]" value="{{ $listArrayIP->DATEREGULE }}">
                                        <?php
                                            if(isset($listArrayIP->STADEINC)){
                                        ?>
                                            <input type="hidden" class="form-control" name="STADEIncident[]" value="{{ $listArrayIP->STADEINC }}" >
                                        <?php
                                            }else{
                                        ?>
                                            <input type="hidden" class="form-control" name="STADEIncident[]" value=" " >
                                        <?php
                                            }
                                        ?>
                                    </tr>
                                @endif
                            @endforeach

                            <?php
                                }else{
                            ?>

                            @if ($listArrayIP['DATEREGULE'] == 'EMPTY')
                                <tr>
                                    <td><input class="form-control" name="refIncident" value="{{ $listArrayIP['ID'] }}" readonly></td>
                                    <?php
                                        if(isset($listArrayIP['NUMCHQ'])){
                                    ?>
                                        <td><input class="form-control" name="numChqIncident" value="{{ $listArrayIP['NUMCHQ'] }}" readonly></td>
                                    <?php
                                        }else{
                                    ?>
                                        <td><input class="form-control" name="numChqIncident" value=" " readonly></td>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                        if(isset($listArrayIP['CODEPRESENTATION'])){
                                    ?>
                                        <td><input class="form-control" name="codeIncident" value="{{ $listArrayIP['CODEPRESENTATION'] }}" readonly></td>
                                    <?php
                                        }else{
                                    ?>
                                        <td><input class="form-control" name="codeIncident" value=" " readonly></td>
                                    <?php
                                        }
                                    ?>

                                    <?php
                                    if(isset($listArrayIP['MONTANT'])){
                                    ?>
                                    <td><input class="form-control" name="montantIncident" value="{{ $listArrayIP['MONTANT'] }}" readonly></td>
                                    <?php
                                    }else{
                                    ?>
                                    <td><input class="form-control" name="montantIncident" value=" " readonly></td>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if(isset($listArrayIP['CURRENCY'])){
                                ?>
                                    <td><input class="form-control" name="currencyIncident" value="{{ $listArrayIP['CURRENCY'] }}" readonly></td>
                                <?php
                                    }else{
                                ?>
                                    <td><input class="form-control" name="currencyIncident" value=" " readonly></td>
                                <?php
                                    }
                                ?>
                                    <td>
                                        <?php
                                                if(isset($listArrayIP['DATEEMISSION'])){
                                                $dateConvertimp = strtotime($listArrayIP['DATEEMISSION']);
                                                $dateFinaleimp = date("d/m/Y",$dateConvertimp);
                                        ?>
                                        <input class="form-control" name="dateIncident" value="{{ $dateFinaleimp}}" readonly>
                                        <?php
                                        }else{
                                        ?>
                                                <td><input class="form-control" name="dateIncident" value=" " readonly></td>
                                        <?php
                                            }
                                        ?>
                                    </td>
                                    <td><input class="form-control" name="ribIncident" value="{{ $listArrayIP['RIBBENEF'] }}" readonly></td>
                                    <td><input class="form-control" name="nomBenefIncident" value="{{ $listArrayIP['NOMBENEF'] }}" readonly></td>
                                    <?php
                                        if(isset($listArrayIP['MOTIFREJET'])){
                                    ?>
                                        <td><input class="form-control" name="motifIncident" value="{{ $listArrayIP['MOTIFREJET'] }}" readonly></td>
                                    <?php
                                        }else{
                                    ?>
                                        <td><input class="form-control" name="motifIncident" value=" " readonly></td>
                                    <?php
                                        }
                                    ?>
                                    <input type="hidden" name="DATEREGULEIncident" value="{{ $listArrayIP['DATEREGULE'] }}">
                                    <?php
                                        if(isset($listArrayIP['STADEINC'])){
                                    ?>
                                        <input type="hidden" class="form-control" name="STADEIncident" value="{{ $listArrayIP['STADEINC'] }}">
                                    <?php
                                        }else{
                                    ?>
                                        <input  type="hidden" class="form-control" name="STADEIncident" value=" ">
                                    <?php
                                        }
                                    ?>
                                </tr>
                            @endif

                            <?php
                                }
                            ?>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <br>

            <div class="col-12">
                <!-- radio -->
                <h5 class="card-description text-info"><span class="text-danger">* </span>
                    --- {{ __('Compensation') }} ---
                </h5>
                <hr>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table" id="tab_logic">
                            <thead>
                                <th><span class="text-danger">* </span>Type de transaction</th>
                                <th><span class="text-danger">* </span>Bénéficiaire</th>
                                <th><span class="text-danger">* </span>Montant</th>
                                <th class="text-center"></th>
                            </thead>
                            <tbody>
                                <tr id='addr0'></tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8"></td>
                                    <td>
                                        <a id="add_row" class="btn btn-info"><i
                                                class="fa fa-plus"></i></a>
                                    </td>
                                    <tr>
                                        <td class="text-center text-danger font-weight-bold">{{__('Total')}}</td>
                                        <td colspan="2">
                                            <input id="Total_TTC" name='val_compensation' type='text'
                                                class='form-control input-md'
                                                placeholder='0' readonly>
                                        </td>
                                    </tr>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="custom-content-above-client" role="tabpanel" aria-labelledby="custom-content-above-client-tab">
            <br>
            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-description text-info">--- {{ __('Situation Client') }} ---</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('Solde Actuel') }} :</label>
                                <?php
                                if( isset($listArrayInfGlob['AMOUNT']) ){
                                ?>
                                    <input type="number" step="any" class="form-control" value="{{ $listArrayInfGlob['AMOUNT'] }}" id="solde_comp" name="solde_compensation" readonly/>
                                <?php
                                    }else{
                                ?>
                                    <input type="number" step="any" class="form-control" value="0" id="solde_comp" name="solde_compensation" readonly/>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                            if( isset($listArrayInfGlob['WORKING']) ){
                        ?>
                            <input type="hidden" class="form-control" name="working_balance" value="{{ $listArrayInfGlob['WORKING'] }}"/>
                        <?php
                            }else{
                        ?>
                            <input type="hidden" class="form-control" name="working_balance" value="0"/>
                        <?php
                            }
                        ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('Compensation') }} :</label>
                                <input type="number"  step="any" class="form-control" id="compensation_val" name="compensation_val" readonly/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('Nouveau solde aprés compensation') }} :</label>
                                <input type="text" step="any" name="solde_apres" class="form-control" id="solde_apres" placeholder='0' disabled/>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label> {{ __('Classement du client chez la banque')}} :</label>
                                @if ($listArrayInfGlob['CLASSEMENT'] == 0)
                                    <input type="text" class="form-control" id="classement_client" name="classement_client" value="CREANCES COURANTES - 0" readonly/>
                                @elseif ($listArrayInfGlob['CLASSEMENT'] == 1)
                                    <input type="text" class="form-control" id="classement_client" name="classement_client" value="CREANCES NECESSITANT UN SUIVI PARTICULIER - 1" readonly/>
                                @elseif ($listArrayInfGlob['CLASSEMENT'] == 2)
                                    <input type="text" class="form-control" id="classement_client" name="classement_client" value="CREANCES INCERTAINTES - 2" readonly/>
                                @elseif ($listArrayInfGlob['CLASSEMENT'] == 3)
                                    <input type="text" class="form-control" id="classement_client" name="classement_client" value="CREANCES PREOCCUPANTES - 3" readonly/>
                                @elseif ($listArrayInfGlob['CLASSEMENT'] == 4)
                                    <input type="text" class="form-control" id="classement_client" name="classement_client" value="CREANCES COMPROMESES - 4" readonly/>
                                @elseif ($listArrayInfGlob['CLASSEMENT'] == 5)
                                    <input type="text" class="form-control" id="classement_client" name="classement_client" value="CREANCES AU CONTENTIEUX - 5" readonly/>
                                @endif

                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5 class="card-description text-info">--- {{ __('Impayé à payer') }} ---</h5>
                                <div class="table-responsive">
                                    <table class="table" id="tab_impaye">
                                        <thead>
                                            <th>Nature</th>
                                            <th>Montant</th>
                                            <th>Devise</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <tr id='impaye0'></tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="10"></td>
                                                <td>
                                                    <a id="add_row_impaye" class="btn btn-info"><i
                                                            class="fa fa-plus"></i></a>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5 class="card-description text-info">--- {{ __('Encours chèque') }} ---</h5>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th>{{ __('Référence') }}</th>
                                            <th>{{ __('Montant') }}</th>
                                            <th>{{ __('Devise') }}</th>
                                            <th>{{ __('Num Bord') }}</th>
                                            <th>{{ __('Date d\'encaissement') }}</th>
                                        </thead>
                                        <tbody>
                                            @if ((count($listArrayENCR)>0))
                                            <?php
                                                if(isset($listArrayENCR[0])){
                                            ?>
                                            @foreach ($listArrayENCR as $listArrayENCR)
                                            <tr>
                                                <input type="hidden" name="encours_compensation" value="notEmty">
                                                <td><input class="form-control" name="referenceEnc[]" value="{{ $listArrayENCR->REFERENCE }}" readonly></td>
                                                <?php
                                                    if(isset($listArrayENCR->AMOUNT)){
                                                ?>
                                                    <td><input class="form-control" name="montantEnc[]" value="{{ $listArrayENCR->AMOUNT }}" readonly></td>
                                                <?php
                                                    }else{
                                                ?>
                                                    <td><input class="form-control" name="montantEnc[]" value=" " readonly></td>
                                                <?php
                                                    }
                                                ?>
                                                    <?php
                                                    if(isset($listArrayENCR->CURRENCY)){
                                                    ?>
                                                        <td><input class="form-control" name="deviseEnc[]" value="{{ $listArrayENCR->CURRENCY }}" readonly></td>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <td><input class="form-control" name="deviseEnc[]" value=" " readonly></td>
                                                    <?php
                                                        }
                                                    ?>
                                                    <?php
                                                    if(isset($listArrayENCR->NUMBORD)){
                                                    ?>
                                                        <td><input class="form-control" name="numbord[]" value="{{ $listArrayENCR->NUMBORD }}" readonly></td>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <td><input class="form-control" name="numbord[]" value=" " readonly></td>
                                                    <?php
                                                        }
                                                    ?>
                                                <td><?php   $dateConvertEC = strtotime($listArrayENCR->DATEENCAISS);
                                                    $dateFinaleEC = date("d/m/Y",$dateConvertEC);
                                                    $datef = $dateFinaleEC ?><input class="form-control" name="dateEnc[]" value="{{ $datef }}" readonly>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <?php
                                            }else{
                                            ?>
                                                <tr>
                                                    <td><input class="form-control" name="referenceEnc" value="{{ $listArrayENCR['REFERENCE'] }}" readonly></td>
                                                    <?php
                                                    if(isset($listArrayENCR['AMOUNT'])){
                                                    ?>
                                                        <td><input class="form-control" name="montantEnc" value="{{ $listArrayENCR['AMOUNT'] }}" readonly></td>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <td><input class="form-control" name="montantEnc" value=" " readonly></td>
                                                    <?php
                                                        }
                                                    ?>
                                                    <?php
                                                    if(isset($listArrayENCR['CURRENCY'])){
                                                    ?>
                                                        <td><input class="form-control" name="deviseEnc" value="{{ $listArrayENCR['CURRENCY'] }}" readonly></td>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <td><input class="form-control" name="deviseEnc" value=" " readonly></td>
                                                    <?php
                                                        }
                                                    ?>
                                                        <?php
                                                        if(isset($listArrayENCR['NUMBORD'])){
                                                        ?>
                                                                <td><input class="form-control" name="numbord" value="{{ $listArrayENCR['NUMBORD'] }}" readonly></td>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <td><input class="form-control" name="numbord" value=" " readonly></td>
                                                        <?php
                                                            }
                                                        ?>
                                                    <td><?php   $dateConvertEC = strtotime($listArrayENCR['DATEENCAISS']);
                                                        $dateFinaleEC = date("d/m/Y",$dateConvertEC);
                                                        $datef = $dateFinaleEC ?><input class="form-control" name="dateEnc" value="{{ $datef }}" readonly>
                                                    </td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <h5 class="card-description text-info">
                        --- {{ __('Encours effet à l\'encaissement') }} ---
                    </h5>
                    <hr>
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table ">
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
                                    @if ((count($listArrayEFFET)>0))
                                    <?php
                                        if(isset($listArrayEFFET[0])){
                                    ?>
                                    @foreach ($listArrayEFFET as $listArrayEFFET)
                                        @if ($listArrayEFFET->STATUT == 4)
                                            <tr>
                                                <input type="hidden" name="encours_effet" value="notempty">
                                                <td><input class="form-control" name="cfuEncours[]" value="{{ $listArrayEFFET->ID }}" readonly></td>
                                                <td><input class="form-control" name="numEffetEncours[]" value="{{ $listArrayEFFET->NUMEFFET }}" readonly></td>
                                                <td><input class="form-control" name="nomTireEffet[]" value="{{ $listArrayEFFET->NOMTIRE }}" readonly></td>
                                                <td><input class="form-control" name="ribTireEffet[]" value="{{ $listArrayEFFET->RIBTIRE }}" readonly></td>
                                                <td><input class="form-control" name="montantEffet[]" value="{{ $listArrayEFFET->MONTANTPRINCIPAL }}" readonly></td>
                                                <td>
                                                    <?php
                                                        $dateConvertimp = strtotime($listArrayEFFET->DATEECHEANCE);
                                                        $DATEECHEANCE = date("d/m/Y",$dateConvertimp);
                                                    ?>
                                                    <input class="form-control" name="dateEcheanceEffet[]" value="{{ $DATEECHEANCE }}" readonly>
                                                </td>
                                                <td>
                                                    <?php
                                                        $dateConvertimp = strtotime($listArrayEFFET->DATEREMISE);
                                                        $DATEREMISE = date("d/m/Y",$dateConvertimp);
                                                    ?>
                                                    <input class="form-control" name="dateRemiseEffet[]" value="{{ $DATEREMISE }}" readonly>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <?php
                                        }else{
                                    ?>

                                    @if ($listArrayEFFET['STATUT'] == 4)
                                        <tr>
                                            <td><input class="form-control" name="cfuEncours" value="{{ $listArrayEFFET['ID'] }}" readonly></td>
                                            <td><input class="form-control" name="numEffetEncours" value="{{ $listArrayEFFET['NUMEFFET'] }}" readonly></td>
                                            <td><input class="form-control" name="nomTireEffet" value="{{ $listArrayEFFET['NOMTIRE'] }}" readonly></td>
                                            <td><input class="form-control" name="ribTireEffet" value="{{ $listArrayEFFET['RIBTIRE'] }}" readonly></td>
                                            <td><input class="form-control" name="montantEffet" value="{{ $listArrayEFFET['MONTANTPRINCIPAL'] }}" readonly></td>
                                            <td>
                                                <?php   $dateConvertimp = strtotime($listArrayEFFET['DATEECHEANCE']);
                                                    $DATEECHEANCE = date("d/m/Y",$dateConvertimp);
                                                ?>
                                                <input class="form-control" name="dateEcheanceEffet" value="{{ $DATEECHEANCE}}" readonly>
                                            </td>
                                            <td>
                                                <?php   $dateConvertimp = strtotime($listArrayEFFET['DATEREMISE']);
                                                    $DATEREMISE = date("d/m/Y",$dateConvertimp);
                                                ?>
                                                <input class="form-control" name="dateRemiseEffet" value="{{ $DATEREMISE}}" readonly>
                                            </td>
                                        </tr>
                                    @endif

                                    <?php
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br>
                    <h5 class="card-description text-info">--- {{ __('Couverture') }} ---</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Effet à l\'escompte Encours d\'étude') }} :</label>
                                <input type="number" step="any" name="encaissement_effet_etude" class="form-control "  />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Effet à l\'escompte Encours de validation') }} :</label>
                                <input type="number" step="any" name="encaissement_effet" class="form-control "  />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Versement Espèces') }} :</label>
                                <input type="number" step="any" name="versement" class="form-control "/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('Note Couverture') }} :</label>
                                <textarea type="text" name="note_couverture" class="form-control "></textarea>
                            </div>
                        </div>
                    </div>

                    <br>
                    <h5 class="card-description text-info">--- {{ __('Chiffre d\'affaire Confié') }} ---</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><span class="text-danger">*</span>{{ __('L\'année précédente') }} :</label>
                                <input type="number" step="any" name="chiffre_ans_preced" id="chiffre_ans_preced" class="form-control "  required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><span class="text-danger">*</span>{{ __('Cette année') }} :</label>
                                <input type="number" step="any" name="chiffre_ans_encours" id="chiffre_ans_encours" class="form-control " required/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <br>
            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-description text-info">--- {{ __('Situation Client') }} ---</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-4">
                                    <label><span class="text-danger">*</span>{{ __('Interdit de chéquier ?') }}</label>
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="interdit_chq_client" id="interdit_chq_client_oui" value="oui" required>
                                            <label class="form-check-label radio-inline">{{ __('Oui') }}</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="interdit_chq_client" id="interdit_chq_client_non" value="non">
                                            <label class="form-check-label">{{ __('Non') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                <label>{{ __('Date d\'interdiction') }} :</label>
                                <div class="form-group">
                                    <input type="text" name="interdit_chq_client_date" id="interdit_chq_client_date" placeholder="jj/mm/AAAA" class="form-control " disabled/>
                                </div>
                                </div>
                                <div class="col-4">
                                <label>{{ __('Nombre') }} :</label>
                                <div class="form-group">
                                    <input type="number" name="interdit_chq_client_nombre" id="interdit_chq_client_nombre" class="form-control " disabled/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><span class="text-danger">*</span>{{ __('Classement Client sur le SED') }}</label>
                                <div class="custom-file">
                                    <input type="file" name="engagement_client" class="custom-file-input" id="engagement_client" accept=".pdf" required>
                                    <label class="custom-file-label" for="engagement_client"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label><span class="text-danger">*</span>{{ __('Impayé dans le secteur ?') }}</label>
                            <div class="form-group">
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="montant_non_paye" id="montant_non_paye_oui" value="oui" required>
                                    <label class="form-check-label">{{ __('Oui') }}</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="montant_non_paye" id="montant_non_paye_non" value="non">
                                    <label class="form-check-label">{{ __('Non') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label><span class="text-danger">*</span>{{ __('Risque Client sur le SED') }}</label>
                            <div class="custom-file">
                                <input type="file" name="risque_client" class="custom-file-input" accept=".pdf" id="risque_client" required>
                                <label class="custom-file-label" for="risque_client"></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label><span class="text-danger">*</span>{{ __('Dépassement sur les engagements ?') }}</label>
                            <div class="form-group">
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="depassement" id="depassement_oui" value="oui" required>
                                    <label class="form-check-label">{{ __('Oui') }}</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="depassement" id="depassement_non" value="non">
                                    <label class="form-check-label">{{ __('Non') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Garanties') }} :</label>
                                <div class="custom-file">
                                    <input type="file" name="garantie" class="custom-file-input" accept=".pdf" id="garantie">
                                    <label class="custom-file-label" for="garantie"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                            <div class="col-4">
                                <label><span class="text-danger">*</span>{{ __('Etat Financier fournie ?') }} </label>
                                <div class="form-group">
                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="liste_finance_final" id="liste_finance_final_oui" value="oui" required>
                                        <label class="form-check-label">{{ __('Oui') }}</label>
                                    </div>
                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="liste_finance_final" id="liste_finance_final_non" value="non">
                                        <label class="form-check-label">{{ __('Non') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <label>{{ __('Année') }} :</label>
                                <div class="form-group">
                                    <input type="number" name="annee_etat_financier" id="annee_etat_financier" class="form-control " disabled />
                                </div>
                            </div>
                            <div class="col-4">
                                <label>{{ __('Type') }} :</label>
                                <div class="form-group">
                                    <select class="form-control" name="type_etat_financier" id="type_etat_financier" disabled>
                                        <option value="_"> </option>
                                        <option value="provisoire">Provisoire</option>
                                        <option value="certifié">Certifié</option>
                                        <option value="définitif">Définitif</option>
                                    </select>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!--<div class="form-group">
                                <label>{{ __('Autorisation') }} :</label>
                                <input type="number" step="any" name="ligne_fournie" class="form-control " />
                            </div> -->
                        </div>


                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-4">
                                    <label><span class="text-danger">*</span>{{ __('Rapport commissaire au compte ?') }}</label>
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="liste_finance_rapport" id="liste_finance_rapport_oui" value="oui" required>
                                            <label class="form-check-label">{{ __('Oui') }}</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="liste_finance_rapport" id="liste_finance_rapport_non" value="non">
                                            <label class="form-check-label">{{ __('Non') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label>{{ __('Année') }} :</label>
                                    <div class="form-group">
                                        <input type="number" name="anneecommissaire" id="anneecommissaire" class="form-control " disabled/>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label>{{ __('Réserve') }} :</label>
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="liste_finance_rapport_reserve" id="liste_finance_rapport_reserve_oui" value="oui">
                                            <label class="form-check-label">{{ __('Oui') }}</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="liste_finance_rapport_reserve" id="liste_finance_rapport_reserve_non" value="non">
                                            <label class="form-check-label">{{ __('Non') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('Chiffre d\'affaire global N') }} </label>
                                        <input type="number" step="any" name="nb_transaction" class="form-control "  />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('Resultat net N') }} </label>
                                        <input type="number" step="any" name="resultat_brut" class="form-control "  />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('Chiffre d\'affaire global N-1') }} </label>
                                        <input type="number" step="any" name="chiffre_n" class="form-control "  />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('Resultat net N-1') }} </label>
                                        <input type="number" step="any" name="resultat_n" class="form-control "  />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <h5 class="card-description text-info">--- {{ __('Les tombés d\'échéance (Dans 2 semaines)') }}---</h5>
                    <hr>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-12">
                            <div class="form-group">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th>{{ __('Référence') }}</th>
                                            <th>{{ __('Nature') }}</th>
                                            <th>{{ __('Montant') }}</th>
                                            <th>{{ __('Devise') }}</th>
                                            <th>{{ __('Date d\'écheance') }}</th>
                                            <th>{{ __('Date proche') }}</th>
                                        </thead>
                                        <tbody>
                                            @if (count($listArrayTMBE)>0)
                                                <?php
                                                    if(isset($listArrayTMBE[0])){
                                                ?>
                                                @foreach ($listArrayTMBE as $listArrayTMBE)
                                                <tr>
                                                    <input type="hidden" name="tombe_compensation" value="notEmty">
                                                    <td><input class="form-control" name="referenceTombe[]" value="{{ $listArrayTMBE->ENGAGEMENT }}" readonly></td>
                                                    <?php
                                                        if( isset($listArrayTMBE->LIBELLECREDIT) ){
                                                    ?>
                                                        <td><input class="form-control" name="natureTombe[]" value="{{ $listArrayTMBE->LIBELLECREDIT }}" readonly></td>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <td><input class="form-control" name="natureTombe[]" value=" " readonly></td>
                                                    <?php
                                                        }
                                                    ?>
                                                    <td><input class="form-control" name="montantTombe[]" value="{{ $listArrayTMBE->ENCOURS }}" readonly></td>
                                                    <td><input class="form-control" name="deviseTombe[]" value="{{ $listArrayTMBE->CURRENCY }}" readonly></td>
                                                    <td><?php   $dateConvertDE = strtotime($listArrayTMBE->ECHEDATE);
                                                        $dateFinaleDE = date("d/m/Y",$dateConvertDE);
                                                        $dfDE = $dateFinaleDE ?><input class="form-control" name="date_echTombe[]" value="{{ $dfDE }}" readonly>
                                                    </td>
                                                    <?php
                                    if( isset($listArrayTMBE->DATEPROCH) ){
                                    $dateConvertDP = strtotime($listArrayTMBE->DATEPROCH);
                                    $dateFinaleDP = date("d/m/Y",$dateConvertDP);
                                    $dfDP = $dateFinaleDP ?>
                                        <td><input class="form-control" name="date_procheTombe[]" value="{{ $dfDP }}" readonly></td>
                                   <?php
                                        }else{
                                    ?>
                                        <td><input class="form-control" name="date_procheTombe[]" value=" " readonly></td>
                                    <?php
                                        }
                                    ?>
                                                    <input type="hidden" name="categoryTombe[]" value="{{ $listArrayTMBE->CATEGORY }}">
                                                </tr>
                                                @endforeach

                                                <?php }else{
                                                ?>
                                                <tr>
                                                    <td><input class="form-control" name="referenceTombe" value="{{ $listArrayTMBE['ENGAGEMENT'] }}" readonly></td>
                                                    <?php
if( isset($listArrayTMBE['LIBELLECREDIT']) ){
?>
<td><input class="form-control" name="natureTombe" value="{{ $listArrayTMBE['LIBELLECREDIT'] }}" readonly></td>
<?php
}else{
?>
<td><input class="form-control" name="natureTombe" value=" " readonly></td>
<?php
}
?>
                                                    <td><input class="form-control" name="montantTombe" value="{{ $listArrayTMBE['ENCOURS'] }}" readonly></td>
                                                    <td><input class="form-control" name="deviseTombe" value="{{ $listArrayTMBE['CURRENCY'] }}" readonly></td>
                                                    <td><?php   $dateConvertDE = strtotime($listArrayTMBE['ECHEDATE']);
                                                        $dateFinaleDE = date("d/m/Y",$dateConvertDE);
                                                        $dfDE = $dateFinaleDE ?><input class="form-control" name="date_echTombe" value="{{ $dfDE }}" readonly>
                                                    </td>
                                                    <td>
                                                        <?php
                                                                if( isset($listArrayTMBE['DATEPROCH']) ){
                                                                    $dateConvertDP = strtotime($listArrayTMBE['DATEPROCH']);
                                                                    $dateFinaleDP = date("d/m/Y",$dateConvertDP);
                                                                    $dfDP = $dateFinaleDP
                                                                ?>
                                                                    <input class="form-control" name="date_procheTombe" value="{{ $dfDP }}" readonly>
                                                                <?php }else{ ?>
                                                                    <input class="form-control" name="date_procheTombe" value=" " readonly>
                                                                <?php } ?>
                                                    </td>
                                                    <input type="hidden" name="categoryTombe" value="{{ $listArrayTMBE['CATEGORY'] }}">
                                                </tr>
                                                <?php } ?>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php
            }
        ?>
        @endif


        <div class="tab-pane fade" id="custom-content-above-comp" role="tabpanel" aria-labelledby="custom-content-above-comp-tab">
            <br>
            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-description text-info">--- {{ __('Informations sur la dérniere compensation') }} ---</h5>
                    <hr>
                    <div class="row">
                        @if($derniere_compensation !== null)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date">{{ __('Date') }} :</label>
                                    <input type="text" class="form-control input-sm" name="date_der_comp_new" value="{{ $derniere_compensation->date_compensation->format('d-m-Y') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{ __('Montant') }} :</label>
                                        <input type="number" step="any" name="montant_der_comp" class="form-control" value="{{ $derniere_compensation->val_compensation }}" readonly/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{ __('Décision de la comité') }} :</label>
                                            @if($derniere_compensation->status == 4)
                                                <input type="text" name="decision_der_comp" class="form-control " value="avis favorable par chargé clientèle" readonly/>
                                                @elseif ($derniere_compensation->status == 5)
                                                <input type="text" name="decision_der_comp" class="form-control " value="avis défavorable par chargé clientèle" readonly/>
                                                @elseif ($derniere_compensation->status == 6)
                                                <input type="text" name="decision_der_comp" class="form-control " value="avis défavorable par chef d'agence" readonly/>
                                                @elseif ($derniere_compensation->status == 7)
                                                <input type="text" name="decision_der_comp" class="form-control " value="avis favorable par chef d'agence" readonly/>
                                                @elseif ($derniere_compensation->status == 8)
                                                <input type="text" name="decision_der_comp" class="form-control " value="avis défavorable par exploitation corporate" readonly/>
                                                @elseif ($derniere_compensation->status == 9)
                                                <input type="text" name="decision_der_comp" class="form-control " value="avis favorable par exploitation corporate" readonly/>
                                                @elseif ($derniere_compensation->status == 10)
                                                <input type="text" name="decision_der_comp" class="form-control " value="avis défavorable par exploitation particulier" readonly/>
                                                @elseif ($derniere_compensation->status == 11)
                                                <input type="text" name="decision_der_comp" class="form-control " value="avis favorable par exploitation particulier" readonly/>
                                                @elseif ($derniere_compensation->status == 12)
                                                <input type="text" name="decision_der_comp" class="form-control " value="avis défavorable par exploitation" readonly/>
                                                @elseif ($derniere_compensation->status == 13)
                                                <input type="text" name="decision_der_comp" class="form-control " value="avis favorable par exploitation" readonly/>
                                                @elseif ($derniere_compensation->status == 14)
                                                <input type="text" name="decision_der_comp" class="form-control " value="avis défavorable par risque" readonly/>
                                                @elseif ($derniere_compensation->status == 15)
                                                <input type="text" name="decision_der_comp" class="form-control " value="avis favorable par risque" readonly/>
                                                @elseif ($derniere_compensation->status == 16)
                                                <input type="text" name="decision_der_comp" class="form-control " value="Avis défavorable par direction générale" readonly/>
                                                @elseif ($derniere_compensation->status == 17)
                                                <input type="text" name="decision_der_comp" class="form-control " value="Avis favorable par direction générale" readonly/>
                                                @elseif ($derniere_compensation->status == 18)
                                                <input type="text" name="decision_der_comp" class="form-control " value="Avis défavorable par DGA" readonly/>
                                                @elseif ($derniere_compensation->status == 19)
                                                <input type="text" name="decision_der_comp" class="form-control " value="Avis favorable par DGA" readonly/>
                                                @elseif ($derniere_compensation->status == 20)
                                                <input type="text" name="decision_der_comp" class="form-control " value="Avis favorable par chef d'agence suite à un arbitrage" readonly/>
                                                @elseif ($derniere_compensation->status == 21)
                                                <input type="text" name="decision_der_comp" class="form-control " value="Avis défavorable par chef d'agence suite à un arbitrage" readonly/>
                                                @elseif ($derniere_compensation->status == 22)
                                                <input type="text" name="decision_der_comp" class="form-control " value="Avis favorable par exploitation suite à un arbitrage" readonly/>
                                                @elseif ($derniere_compensation->status == 23)
                                                <input type="text" name="decision_der_comp" class="form-control " value="Avis défavorable par exploitation suite à un arbitrage" readonly/>
                                                @elseif ($derniere_compensation->status == 24)
                                                <input type="text" name="decision_der_comp" class="form-control " value="Avis défavorable par risque suite à un arbitrage" readonly/>
                                                @elseif ($derniere_compensation->status == 25)
                                                <input type="text" name="decision_der_comp" class="form-control " value="Avis favorable par risque suite à un arbitrage" readonly/>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>{{ __('Respect des promesses faites') }} :</label>
                                        <div class="form-group">
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="radio" name="respect_promet" id="oui" value="oui">
                                                <label class="form-check-label">{{ __('Oui') }}</label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="radio" name="respect_promet" id="non" value="non">
                                                <label class="form-check-label">{{ __('Non') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <th>{{ __('Promesse') }}</th>
                                                <th>{{ __('Values') }}</th>
                                            </thead>
                                            @foreach ($derniere_compensation->justification_comp as $just)
                                                    <tbody>
                                                    <tr>
                                                    <td>{!! nl2br(htmlspecialchars($just->name_justification_update, ENT_NOQUOTES)) !!}</td>
                                                    <td>{{ $just->value }}</td>

                                                    </tr>
                                                    </tbody>
                                            @endforeach
                                        </table>
                                    </div>

                                    @foreach ($derniere_compensation->justification_comp as $just)
                                    <input type="hidden" name="input_justif" value="notEmpty">
                                    <input type="hidden" name="promesse_new[]" value="{{ $just->name_justification_update }}">
                                    <input type="hidden" name="valeur[]" value="{{ $just->value }}">
                                    @endforeach

                                </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('Note') }} :</label>
                                        <textarea type="text" name="note_der_comp_update" class="form-control "></textarea>
                                    </div>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="custom-content-above-ben" role="tabpanel" aria-labelledby="custom-content-above-ben-tab">
            <br>
            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-description text-info">--- {{ __('Informations sur le Client') }} ---</h5>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    <label><span class="text-danger">*</span>{{ __('Est-ce qu\'il a d\'autres sociétés ?') }} :</label>
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="interdit_chq_ben" id="interdit_chq_ben_oui" value="oui" required>
                                            <label class="form-check-label">{{ __('Oui') }}</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="interdit_chq_ben" id="interdit_chq_ben_non" value="non">
                                            <label class="form-check-label">{{ __('Non') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Situation des sociétés du client avec la banque') }} :</label>
                                        <input type="text" name="situation_banque_ben" class="form-control " />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Situation du gérant et le client avec la banque') }} :</label>
                                        <input type="text" name="situation_agent_benf" class="form-control " />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="addSC">
                        <div class="col-4">
                            <label>{{ __('code') }} :</label>
                            <input type="text" name="code_autre_sc" class="form-control " id="code_autre_sc" disabled/>
                        </div>
                        <div class="col-4">
                            <label>{{ __('Nom') }} :</label>
                            <input type="text" name="nom_autre_sc" class="form-control " id="nom_autre_sc" disabled/>
                        </div>
                        <div class="col-4">
                            <label>{{ __('Activité') }} :</label>
                            <input type="text" name="activite_autre_sc" class="form-control " id="activite_autre_sc" disabled/>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('Engagement sur le SED') }} :</label>
                                <div class="custom-file">
                                    <input type="file" name="engagement_sed_ben" class="custom-file-input" id="engagement_sed_ben" accept=".pdf" disabled>
                                    <label class="custom-file-label" for="engagement_sed_ben"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('Classement') }} :</label>
                                <div class="custom-file">
                                    <input type="file" name="classement_ben" class="custom-file-input" id="classement_ben" accept=".pdf" disabled>
                                    <label class="custom-file-label" for="classement_ben"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="custom-content-above-messages" role="tabpanel" aria-labelledby="custom-content-above-messages-tab">
            <br>
            <div class="row">
                <div class="col-12">
                    <h5 class="card-description text-info">--- {{ __('Justifications d\'agence pour payer la compensation') }} ---</h5>
                    <hr>
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table" id="tab_justif">
                                <thead>
                                    <th>Promesses</th>
                                    <th>Montant</th>
                                    <th class="text-center"></th>
                                </thead>
                                <tbody>
                                    <tr id='just0'></tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="8"></td>
                                        <td>
                                            <a id="add_row_just" class="btn btn-info"><i
                                                    class="fa fa-plus"></i></a>
                                        </td>
                                        <tr>
                                            <td class="text-center text-danger font-weight-bold">{{__('Total des justifications')}}</td>
                                            <td colspan="2">
                                                <input id="Total_justif" name='justification' type='text'
                                                    class='form-control input-md'
                                                    placeholder='0' readonly></td>
                                        </tr>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="custom-content-above-compte" role="tabpanel" aria-labelledby="custom-content-above-compte-tab">
            <br>
            <h5 class="card-description text-info">--- {{ __(' Comptes Client') }} ---</h5>
            <hr>

            @if ((count($listAutreCompte)>0))
            <?php
                if( isset($listAutreCompte[0]) ){
            ?>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <div class="table-responsive">

                            <table class="table">
                                <thead>
                                    <th>{{ __('Num Compte') }}</th>
                                    <th>{{ __('Montant') }}</th>
                                    <th>{{ __('category') }}</th>
                                </thead>

                                <tbody>
                                    @foreach ($listAutreCompte as $key => $listAutreCompte)

                                        <tr>
                                            <input type="hidden" name="autreCompte" value="notEmpty">
                                            <td><input class="form-control" name="numCompteACC[]" value="{{ $listAutreCompte->ACCOUNT }}" readonly></td>
                                            <?php
                                            if( isset($listAutreCompte->AMOUNT) ){
                                            ?>
                                                <td><input class="form-control" name="montantACC[]" value="{{ $listAutreCompte->AMOUNT }}" readonly></td>
                                            <?php
                                                }else{
                                            ?>
                                                <td><input class="form-control" name="montantACC[]" value="0" readonly></td>
                                            <?php
                                                }
                                            ?>
                                                <td><input class="form-control" name="categoryACC[]" value="{{ $listAutreCompte->CATEGORY }}" readonly></td>
                                        </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                }
            ?>
            @endif

        </div>

        </div>
    </div>
    <!-- /.card -->
    </form>
    </div>
    <!-- /.card -->
</div>
@endsection