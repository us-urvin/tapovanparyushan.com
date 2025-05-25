<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth | Tapovan Paryushan Aradhana</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-white">
    <div class="flex min-h-screen flex-col md:flex-row">
        <!-- Left: Image Placeholder (hidden on mobile) -->
        <div class="hidden md:flex w-1/2 bg-cover bg-center items-center justify-center" style="background-color: #f5f5f5;">
            <!-- Placeholder for image, replace with your image -->
            <div class="w-full h-full flex items-center justify-center">
                <span class="text-gray-400 text-lg">[ Add your image here ]</span>
            </div>
        </div>
        <!-- Right: Content -->
        <div class="w-full md:w-1/2 flex flex-col justify-center items-center bg-white py-8 md:py-0">
            <div class="w-full max-w-md px-4 sm:px-6 md:px-8">
                <!-- Logo Placeholder -->
                <div class="flex flex-col items-center mb-8">
                    <div class="h-24 w-24 bg-gray-200 rounded-full mb-4 flex items-center justify-center">
                        <span class="text-gray-400">[Logo]</span>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html> 