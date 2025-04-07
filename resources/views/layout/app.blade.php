<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    @include('layout.header')

    <div class="d-flex flex-grow-1" style="min-height: 0;">
        @include('layout.sidebar')

        <main class="flex-grow-1 p-4 overflow-auto">
            @yield('content')
        </main>
    </div>

    @include('layout.footer')
    @include('partials.scripts')

</body>
</html>
