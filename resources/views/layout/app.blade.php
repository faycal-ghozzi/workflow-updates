<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
{{-- @include('partials.head'); --}}
<body class="layout-navbar-fixed sidebar-mini">
    <div class="wrapper">
        {{-- @include('layout.header') --}}
        {{-- @include('layout.sidebar') --}}

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/favicon.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Add a loading spinner and overlay -->
        <div id="loading-overlay">
            <div id="loading-spinner"></div>
        </div>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>
        {{-- @include('layout.footer') --}}

    </div>
    {{-- @include('partials.scripts') --}}
</body>
</html>
