<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tapovan Paryushan Aradhana</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @stack('style')
</head>
<body class="min-h-screen bg-white">
    <div class="flex min-h-screen flex-col md:flex-row">
        <!-- Left: Image Placeholder (hidden on mobile) -->
        <div class="hidden md:flex w-1/2 relative bg-cover bg-center items-center justify-center" style="background-color: #F8F5ED;">
            <img src="{{ asset('images/temple.png') }}" alt="Tapovan Paryushan Aradhana" class="absolute inset-0 w-full h-full object-cover">
        </div>
        <!-- Right: Content -->
        <div class="w-full md:w-1/2 flex flex-col justify-center items-center bg-[#F8F5ED] py-8 md:py-0">
            <div class="w-full max-w-md px-4 sm:px-6 md:px-8">
                <div class="flex flex-col items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Tapovan Paryushan Aradhana" class="w-40 h-40">
                </div>
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                background: '#f8f5ed',
                confirmButtonColor: "#C9A14A"
            })
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                background: '#f8f5ed',
                confirmButtonColor: "#C9A14A"
            })
        @endif

        @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: '{{ session('info') }}',
                background: '#f8f5ed',
                confirmButtonColor: "#C9A14A"
            })
        @endif

        @if(session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: '{{ session('warning') }}',
                background: '#f8f5ed',
                confirmButtonColor: "#C9A14A"
            })
        @endif
    </script>
</body>
</html> 