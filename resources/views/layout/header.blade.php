<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0">
    <!-- Left navbar links -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">

      <!-- Authentication -->
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a class="nav-link" href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Déconnexion') }}
        </a>
      </form>



    </ul>
  </nav>

{{-- <meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0">
    <!-- Left navbar links -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">

        @if ((Auth::user()->username =='swiftmanel')||(Auth::user()->username =='1162')||(Auth::user()->username =='1384')||(Auth::user()->username =='1182'))
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="roleDropdown" href="#"
                data-toggle="dropdown">
                    Current Profile :
                    @if(auth()->check())
                        @if( 	(auth()->user()->hasRole('Exploitation_corporate'))
                                && (auth()->user()->hasRole('Exploitation_particulier'))
                                && (auth()->user()->hasRole('Exploitation_décideur_chq'))
                                && (auth()->user()->hasRole('Exploitation_placement'))
                            )
                            Exploitation corporate/particulier
                        @elseif(auth()->user()->hasRole('Exploitation_décideur'))
                            Direction Exploitation
                        @endif
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                    aria-labelledby="roleDropdown">
                    <a class="dropdown-item preview-item py-3" href="#" onclick="changeRole('test1')">
                        Exploitation corporate/particulier
                    </a>
                    <a class="dropdown-item preview-item py-3" href="#" onclick="changeRole('test2')">
                        Direction Exploitation
                    </a>
                </div>
            </li>
        @endif


        @if ((Auth::user()->username =='1269'))
        <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="roleDropdown" href="#"
            data-toggle="dropdown">
                Current Profile :
                @if(auth()->check())
                    @if( 	auth()->user()->hasRole('Chef_agence')
                        )
                        Chef d'agence
                    @elseif(auth()->user()->hasRole('Charge'))
                        Chargé de clientèle
                    @endif
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                aria-labelledby="roleDropdown">
                <a class="dropdown-item preview-item py-3" href="#" onclick="changeRoleAgence('chef')">
                    Chef d'agence
                </a>
                <a class="dropdown-item preview-item py-3" href="#" onclick="changeRoleAgence('charge')">
                    Chargé de clientèle
                </a>
            </div>
        </li>
    @endif

      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
          data-toggle="dropdown">
            @switch(session()->get('locale'))
                @case('ar')
                <img src="{{asset('../dist/img/flags/ar.png')}}" width="25px">
                @break
                @case('fr')
                <img src="{{asset('../dist/img/flags/fr.png')}}" width="25px">
                @break
                @default
                <img src="{{asset('../dist/img/flags/fr.png')}}" width="25px">
                @break
            @endswitch
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
            aria-labelledby="notificationDropdown">
            <a class="dropdown-item preview-item py-3" href="/lang/fr">
                <div class="preview-thumbnail">
                    <i class="flag-icon flag-icon-fr"></i>
                </div>
                <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal text-dark mb-1">Français</h6>
                </div>
            </a>
            <a class="dropdown-item preview-item py-3" href="/lang/ar">
                <div class="preview-thumbnail">
                    <i class="flag-icon flag-icon-sa"></i>
                </div>
                <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal text-dark mb-1">عربية</h6>
                </div>
            </a>
        </div>
      </li>


      <style>
      /* Add this CSS to your stylesheet */
        .notification-dropdown {
            background-color: #fff; /* Background color */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Drop shadow */
            width: 800px; /* Set the desired width */
            max-height: 600px; /* Define the maximum height to enable scrolling */
            overflow-y: auto; /* Enable vertical scrollbar when content exceeds max-height */
        }

        .notification-category {
            background-color: #f9f9f9; /* Category background color */
            border: 1px solid #e0e0e0; /* Category border */
            border-radius: 5px; /* Rounded corners */
            padding: 10px; /* Spacing within each category */
            margin-bottom: 10px;
        }

        .notification-item.read {
            background-color: #f0f0f0; /* Read notification background color */
            color: #666; /* Read notification text color */
        }
        .notification-item.unread {
            background-color: #ffffff; /* Unread notification background color */
            color: #333; /* Unread notification text color */
        }

        .type{
            font-family: "Times New Roman",Times,serif;
        }

        .notification-container {
            padding: 10px;
        }

        .notification-category h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }
        .notification-list {
            max-height: 300px; /* Define the maximum height for the notification list */
            overflow-y: auto; /* Enable vertical scrollbar when content exceeds max-height */
        }
        .notification-item {
            text-decoration: none;
            color: #333;
            transition: background-color 0.3s;
        }
        .notification-item:hover {
            background-color: #e1e1e1;
        }
        .notification-content {
            padding: 10px;
        }
        .notification-title {
            font-size: 16px;
            margin: 0;
            font-weight: 600;
        }
        .notification-time {
            font-size: 12px;
            color: #888;
        }


      </style>

    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-light bg-success badge-xs">{{auth()->user()->unreadNotifications->count()}}</span>
        </a>
        <div class="dropdown-menu col-12 dropdown-menu-lg dropdown-menu-right notification-dropdown">
            @php
            $groupedNotifications = auth()->user()->notifications->groupBy(function ($notification) {
                return $notification->data['type'];
            });
            @endphp


            <a href="{{route('mark-as-read')}}" class="dropdown-item dropdown-footer">Mark All as Read</a>
            <div class="dropdown-divider"></div>
            <div class="notification-container">
                @foreach ($groupedNotifications as $type => $notifications)
                    @php
                    $notificationCount = $notifications->count();
                    @endphp
                    <div class="notification-category">
                        <h3 class="type">{{ $type }} (Total {{ $notificationCount }}):</h3>
                        <div class="notification-list">
                            @foreach ($notifications as $notification)

                                <div class="dropdown-divider"></div>

                                <a href="{{ $notification->data['link'] }}" class="notification-item {{ $notification->read_at ? 'read' : 'unread' }}">

                                    <div class="notification-content">
                                        <h4 class="notification-title">
                                            @if ($notification->data['finale'] == 'Not finale')
                                            {{ $notification->data['data'] }}
                                            @else
                                            {{ $notification->data['text'] }}
                                            @endif
                                        </h4>
                                        <p class="notification-time"><i class="far fa-clock mr-1"></i>
                                            {{ date("d-m-Y H:i:s", strtotime($notification->created_at . "+1 hour")) }}
                                        </p>


                                    </div>
                                </a>
                                <div class="notification-actions">
                                    @if ($notification->read_at)
                                        <button class="mark-as-unread-button" data-notification-id="{{ $notification->id }}">Mark as Unread</button>
                                    @else
                                        <button class="mark-as-read-button" data-notification-id="{{ $notification->id }}">Mark as Read</button>
                                        <button class="delete-notification-button" data-notification-id="{{ $notification->id }}">Delete</button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </li>

      <!-- Authentication -->
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a class="nav-link" href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Déconnexion') }}
        </a>
      </form>



    </ul>
  </nav>

  <script src="../../plugins/jquery/jquery.min.js"></script>


  <script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.mark-as-read-button').click(function() {
            console.log('as read clicked !');
            const notificationId = $(this).data('notification-id');
            console.log(notificationId);
            // Make an Ajax request to mark the notification as read.
            $.post('/mark-as-read/' + notificationId, function() {
                // Update the UI to mark the notification as read.
                $(this).closest('.notification-item').addClass('read');
            });
        });

        $('.mark-as-unread-button').click(function() {
            const notificationId = $(this).data('notification-id');
            // Make an Ajax request to mark the notification as unread.
            $.post('/mark-as-unread/' + notificationId, function() {
                // Update the UI to mark the notification as unread.
                $(this).closest('.notification-item').removeClass('read');
            });
        });

        $('.delete-notification-button').click(function() {
            const notificationId = $(this).data('notification-id');
            // Make an Ajax request to delete the notification.
            $.post('/delete-notification/' + notificationId, function() {
                // Remove the notification from the UI.
                $(this).closest('.notification-item').remove();
            });
        });
    });
    function changeRole(role) {
        fetch('{{ route('change.role') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                role: role
            })
        })
        .then(response => {
            if(response.ok){
                console.log('ok');
                window.location.reload();
            }

        })
        .catch(error => {
            console.error('Error:', error); // Handle error
            alert('Error changing role'); // You can replace this with your desired action
        });
    }


    function changeRoleAgence(role) {
        fetch('{{ route('change.roleAgence') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                role: role
            })
        })
        .then(response => {
            if(response.ok){
                console.log('ok');
                window.location.reload();
            }

        //response.json()
        })
        .catch(error => {
            console.error('Error:', error); // Handle error
            alert('Error changing role'); // You can replace this with your desired action
        });
    }


</script>
  <!-- /.navbar --> --}}
