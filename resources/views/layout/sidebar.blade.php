<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="position:relative; left:20px">
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            {{-- <div class="image">
                <img src="{{ asset('user.png') }}" class="img-circle elevation-2" alt="User Image">
            </div> --}}
            <div class="info">
                <a href="#" class="d-block">Username</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu">

                <!-- COMPENSATION -->
                <li class="nav-item {{ request()->is('compensation') ? 'active' : '' }}">
                    <a href="{{ url('/compensation') }}" class="nav-link">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>{{ __('Compensation') }}</p>
                    </a>
                </li>

                <!-- You can uncomment below items if needed -->

                {{-- <!-- CHEQUIER -->
                <li class="nav-item {{ request()->is('chequier') ? 'active' : '' }}">
                    <a href="{{ url('/chequier') }}" class="nav-link">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>{{ __('Chéquier') }}</p>
                    </a>
                </li> --}}

                {{-- <!-- PLACEMENT -->
                <li class="nav-item {{ request()->is('placement') ? 'active' : '' }}">
                    <a href="{{ url('/placement') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>{{ __('Placements') }}</p>
                    </a>
                </li>

                <!-- CLÔTURE -->
                <li class="nav-item {{ request()->is('cloture') ? 'active' : '' }}">
                    <a href="{{ url('/cloture') }}" class="nav-link">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>{{ __('Clôture des comptes') }}</p>
                    </a>
                </li>

                <!-- ADMIN USERS -->
                <li class="nav-item {{ request()->is('user') || request()->is('listAuthetificatedUser') ? 'active' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{ __('Users') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/user') }}" class="nav-link {{ request()->is('user') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Users List') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/listAuthetificatedUser') }}" class="nav-link {{ request()->is('listAuthetificatedUser') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Authenticated Users') }}</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

            </ul>
        </nav>
    </div>
</aside>


{{-- <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('../dist/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image" style="position:relative; left:20px">
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('../dist/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                <x-agency-link :agence-id="Auth::user()->agence_id" />
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">

                <!-- COMPENSATION -->
                @if ((Auth::user()->username =='1449')
                    ||(Auth::user()->hasRole('Charge'))||(Auth::user()->hasRole('Chef_agence'))
                    ||(Auth::user()->hasRole('Exploitation_corporate'))||(Auth::user()->hasRole('Exploitation_particulier'))
                    ||(Auth::user()->hasRole('Exploitation_décideur'))||(Auth::user()->hasRole('Risque'))
                    ||(Auth::user()->hasRole('PDG')) || (Auth::user()->hasRole('DGA')) || (Auth::user()->hasRole('CompensationSeen')))
                    <li class="nav-item {{ (request()->is('compensation')) || (request()->is('historique'))
                    || (request()->is('extrait')) || (request()->is('compensation/add')) || (request()->is('etatJournaliere')) ?'active menu-open':'' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-balance-scale"></i>
                            <p>
                                {{ __('Compensation') }}
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/compensation') }}" class="nav-link {{ (request()->is('compensation')) || (request()->is('compensation/add')) ?'active':'' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('List') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/historique') }}" class="nav-link {{ (request()->is('historique'))?'active':'' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('Historique') }}</p>
                                </a>
                            </li>
                            @if (Auth::user()->hasRole('admin')||Auth::user()->hasRole('Risque'))
                                <li class="nav-item">
                                    <a href="{{ url('/etatJournaliere') }}" class="nav-link {{ (request()->is('etatJournaliere'))?'active':'' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Etat Journalier') }}</p>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->hasRole('admin')
                                ||Auth::user()->hasRole('Exploitation_corporate')||Auth::user()->hasRole('Exploitation_particulier')
                                ||Auth::user()->hasRole('Exploitation_décideur')||Auth::user()->hasRole('Risque')
                                ||Auth::user()->hasRole('PDG')||Auth::user()->hasRole('DGA'))
                                <li class="nav-item">
                                    <a href="{{ url('/extrait') }}" class="nav-link {{ (request()->is('extrait'))?'active':'' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Extrait') }}</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                <!-- CHEQUIER -->
                @if ((Auth::user()->username =='1449')
                    ||(Auth::user()->hasRole('Charge'))||(Auth::user()->hasRole('Chef_agence'))|| Auth::user()->hasRole('ChequeSeen')
                    ||(Auth::user()->hasRole('Exploitation_décideur'))||(Auth::user()->hasRole('Exploitation_décideur_chq'))
                    ||(Auth::user()->hasRole('Risque'))||(Auth::user()->hasRole('Risque_chq')))

                    <li class="nav-item {{ (request()->is('chequier')) || (request()->is('chequier/historique'))
                                        || (request()->is('chequier/add')) || (request()->is('chequier/pre/add'))
                                        || (request()->is('dashboardChq')) || (request()->is('EtatCharge')) || (request()->is('EtatChef')) || (request()->is('EtatChefarbitrage'))
                                        || (request()->is('EtatExploitation')) || (request()->is('EtatExploitationArbitrage')) || (request()->is('EtatRisque')) ?'active menu-open':'' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                                {{ __('Chéquier') }}
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            @if ((Auth::user()->username =='1449')
                                ||Auth::user()->hasRole('ChequeSeen')
                                ||(Auth::user()->hasRole('Exploitation_décideur'))||(Auth::user()->hasRole('Exploitation_décideur_chq'))
                                ||(Auth::user()->hasRole('Risque'))||(Auth::user()->hasRole('Risque_chq')))
                                <li class="nav-item">
                                    <a href="{{ url('/dashboardChq') }}" class="nav-link {{ (request()->is('dashboardChq'))
                                    || (request()->is('EtatCharge')) || (request()->is('EtatChef')) || (request()->is('EtatChefarbitrage'))
                                    || (request()->is('EtatExploitation')) || (request()->is('EtatExploitationArbitrage')) || (request()->is('EtatRisque')) ?'active':'' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Dashboard') }}</p>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ url('/chequier') }}" class="nav-link {{ (request()->is('chequier')) || (request()->is('chequier/add')) || (request()->is('chequier/pre/add')) ?'active':'' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('List') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/chequier/historique') }}" class="nav-link {{ (request()->is('chequier/historique'))?'active':'' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('Historique') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- PLACEMENT -->
                @if ((Auth::user()->hasRole('admin'))||(Auth::user()->hasRole('salle_marche'))
                    ||(Auth::user()->hasRole('Charge'))||(Auth::user()->hasRole('Chef_agence'))
                    ||(Auth::user()->hasRole('Exploitation_corporate'))||(Auth::user()->hasRole('Exploitation_particulier'))
                    ||(Auth::user()->hasRole('Exploitation_décideur'))||(Auth::user()->hasRole('PDG')) || (Auth::user()->hasRole('DGA'))
                    ||(Auth::user()->hasRole('Exploitation_placement'))||(Auth::user()->hasRole('PlacementSeen')))
                    <li class="nav-item {{ (request()->is('placement')) || (request()->is('placement/historique')) || (request()->is('placement/add')) || (request()->is('Offreplacement')) || (request()->is('Offreplacement/historique')) || (request()->is('Offreplacement/add')) ?'active menu-open':'' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>
                                {{ __('Placements') }}
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item {{ (request()->is('Offreplacement')) || (request()->is('Offreplacement/historique')) || (request()->is('Offreplacement/add')) ?'active menu-open':'' }}">
                                <a href="#" class="nav-link">
                                    <i class="far nav-icon fas fa-user nav-icon"></i>
                                    <p>
                                        {{ __('Offre du placement') }}
                                    <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('/Offreplacement') }}" class="nav-link {{ (request()->is('Offreplacement')) || (request()->is('Offreplacement/add')) ?'active':'' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('List') }}</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/Offreplacement/historique') }}" class="nav-link {{ (request()->is('Offreplacement/historique'))?'active':'' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('Historique') }}</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/placement') }}" class="nav-link {{ (request()->is('placement')) || (request()->is('placement/add')) ?'active':'' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('List') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/placement/historique') }}" class="nav-link {{ (request()->is('placement/historique'))?'active':'' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('Historique') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- CONTROLE PERMANENT -->
                @if ((Auth::user()->hasRole('admin'))||(Auth::user()->hasRole('controle_permanent'))
                    ||(Auth::user()->hasRole('Charge'))||(Auth::user()->hasRole('Chef_agence'))
                    ||(Auth::user()->hasRole('Exploitation_décideur'))||(Auth::user()->hasRole('PDG')) || (Auth::user()->hasRole('DGA'))
                    ||(Auth::user()->hasRole('Exploitation_cloture'))||(Auth::user()->hasRole('cloture_seen')))
                    <li class="nav-item {{ (request()->is('cloture')) || (request()->is('cloture/historique')) || (request()->is('cloture/add')) ?'active menu-open':'' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>
                                {{ __('Clôture des comptes') }}
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/cloture') }}" class="nav-link {{ (request()->is('cloture'))?'active':'' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('List') }} </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/cloture/historique') }}" class="nav-link {{ (request()->is('cloture/historique'))?'active':'' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('Historique') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- ADMIN PARAMETRAGE -->
                @if ((Auth::user()->username =='1449')||(Auth::user()->hasRole('gestion_users')))

                    <li class="nav-item">
                        <a href="{{ url('/client') }}" class="nav-link {{ (request()->is('client'))?'active':'' }}">
                            <i class="nav-icon fas fa-info"></i>
                            <p>
                            Clients VIP
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/joursF') }}" class="nav-link {{ (request()->is('joursF'))?'active':'' }}">
                            <i class="nav-icon fas fa-info"></i>
                            <p>
                            HOLIDAYS
                            </p>
                        </a>
                    </li>
                @endif

                <!-- ADMIN USERS -->
                @if ((Auth::user()->username =='1449')||(Auth::user()->hasRole('gestion_users')))
                    <li class="nav-item {{ (request()->is('privileges')) || (request()->is('user')) || (request()->is('listAuthetificatedUser')) ?'active menu-open':'' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ url('/user') }}" class="nav-link {{ (request()->is('user'))?'active':'' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/listAuthetificatedUser') }}" class="nav-link {{ (request()->is('listAuthetificatedUser'))?'active':'' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Connected Users</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside> --}}
