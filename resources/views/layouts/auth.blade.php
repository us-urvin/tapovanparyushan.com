<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tapovan Paryushan Aradhana</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
</head>
<body class="min-h-screen bg-white">
    <div class="flex min-h-screen flex-col md:flex-row">
        <!-- Left: Image Placeholder (hidden on mobile) -->
        <div class="hidden md:flex w-1/2 relative bg-cover bg-center items-center justify-center" style="background-color: #f5f5f5;">
            <img src="{{ asset('images/temple.png') }}" alt="Tapovan Paryushan Aradhana" class="absolute inset-0 w-full h-full object-cover rounded-l-2xl">
        </div>
        <!-- Right: Content -->
        <div class="w-full md:w-1/2 flex flex-col justify-center items-center bg-white py-8 md:py-0">
            <div class="w-full max-w-md px-4 sm:px-6 md:px-8">
                <!-- Logo Placeholder -->
                {{-- <div class="flex flex-col items-center mb-8">
                    <div class="h-24 w-24 bg-gray-200 rounded-full mb-4 flex items-center justify-center">
                        <span class="text-gray-400">[Logo]</span>
                    </div>
                </div> --}}
                <div class="flex flex-col items-center mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="Tapovan Paryushan Aradhana" class="w-40 h-40">
                </div>
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    @stack('scripts')
    <script>
        @if(session('error'))
            iziToast.error({
                title: 'Error',
                message: '{{ session('error') }}',
                position: 'topRight',
                timeout: 5000,
                closeOnClick: true,
                closeOnEscape: true,
                displayMode: 'replace'
            });
        @endif

        @if(session('success'))
            iziToast.success({
                title: 'Success',
                message: '{{ session('success') }}',
                position: 'topRight',
                timeout: 5000,
                closeOnClick: true,
                closeOnEscape: true,
                displayMode: 'replace'
            });
        @endif

        @if(session('info'))
            iziToast.info({
                title: 'Info',
                message: '{{ session('info') }}',
                position: 'topRight',
                timeout: 5000,
                closeOnClick: true,
                closeOnEscape: true,
                displayMode: 'replace'
            });
        @endif

        @if(session('warning'))
            iziToast.warning({
                title: 'Warning',
                message: '{{ session('warning') }}',
                position: 'topRight',
                timeout: 5000,
                closeOnClick: true,
                closeOnEscape: true,
                displayMode: 'replace'
            });
        @endif
    </script>
</body>
</html> 