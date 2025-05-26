<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My App')</title>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

    <!-- Main content area centered -->
    <main class="flex-grow-1 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <a href="/">
                                    <x-application-logo class="img-fluid" style="height: 60px;" />
                                </a>
                            </div>

                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layout.footer')

    {{-- <!-- Footer -->
    <footer class="text-center text-muted py-3 border-top small">
        © {{ now()->year }} BTL Workflow. All rights reserved.
    </footer> --}}

    @include('partials.scripts')
</body>
</html>
