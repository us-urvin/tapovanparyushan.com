<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | Tapovan Paryushan Aradhana</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
</head>
<body class="bg-[#F8F5ED] min-h-screen">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#F8F5ED] border-r border-[#E5E0D8] flex flex-col py-6 px-4">
            <div class="flex flex-col items-center mb-10">
                <div class="h-16 w-16 bg-gray-200 rounded-full flex items-center justify-center mb-2">
                    <span class="text-gray-400">[Logo]</span>
                </div>
                <div class="text-xs text-[#1A2B49] font-bold text-center leading-tight">TAPOVAN PARYUSHAN<br>ARADHANA</div>
            </div>
            <nav class="flex-1">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded-lg font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-[#F3E6C7] text-[#C9A14A]' : 'text-[#1A2B49] hover:bg-[#F3E6C7]' }}">
                            <svg class="w-5 h-5 mr-3 text-[#C9A14A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-4 py-2 rounded-lg font-semibold {{ request()->is('admin/sangh*') ? 'bg-[#F3E6C7] text-[#C9A14A]' : 'text-[#1A2B49] hover:bg-[#F3E6C7]' }}">
                            <svg class="w-5 h-5 mr-3 text-[#C9A14A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            Sangh Profile
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-4 py-2 rounded-lg font-semibold {{ request()->is('admin/events*') ? 'bg-[#F3E6C7] text-[#C9A14A]' : 'text-[#1A2B49] hover:bg-[#F3E6C7]' }}">
                            <svg class="w-5 h-5 mr-3 text-[#C9A14A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6a2 2 0 012-2h6"/></svg>
                            Events
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-4 py-2 rounded-lg font-semibold {{ request()->is('admin/feedback*') ? 'bg-[#F3E6C7] text-[#C9A14A]' : 'text-[#1A2B49] hover:bg-[#F3E6C7]' }}">
                            <svg class="w-5 h-5 mr-3 text-[#C9A14A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8a2 2 0 012-2h2"/></svg>
                            Feedback
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile') }}" class="flex items-center px-4 py-2 rounded-lg font-semibold {{ request()->routeIs('admin.profile') ? 'bg-[#F3E6C7] text-[#C9A14A]' : 'text-[#1A2B49] hover:bg-[#F3E6C7]' }}">
                            <svg class="w-5 h-5 mr-3 text-[#C9A14A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M6 20c0-2.21 3.58-4 8-4s8 1.79 8 4"/></svg>
                            Profile
                        </a>
                    </li>
                </ul>
                <div class="mt-auto pt-8">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-2 rounded-lg font-semibold text-[#1A2B49] hover:bg-[#F3E6C7] focus:outline-none">
                            <svg class="w-5 h-5 mr-3 text-[#C9A14A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </aside>
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header class="flex items-center justify-between bg-[#F8F5ED] px-8 py-4 border-b border-[#E5E0D8]">
                <div class="text-xl font-semibold text-[#1A2B49] flex items-center gap-3">
                    <span>@yield('page-title')</span>
                    @hasSection('sangh-count')
                        <span class="ml-2 bg-[#F3E6C7] text-[#C9A14A] text-xs font-semibold px-3 py-1 rounded">@yield('sangh-count')</span>
                    @endif
                </div>
                <div class="flex items-center gap-6">
                    <button class="relative focus:outline-none">
                        <svg class="w-6 h-6 text-[#1A2B49]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <span class="absolute -top-1 -right-1 bg-[#C9A14A] text-white text-xs rounded-full px-1.5">2</span>
                    </button>
                    <img src="{{ Auth::user()->profile_image_url }}" alt="User" class="w-8 h-8 rounded-full border-2 border-[#C9A14A]">
                    <span class="font-semibold text-[#1A2B49]">{{ Auth::user()->name }}</span>
                </div>
            </header>
            <!-- Page Content -->
            <main class="flex-1 p-8">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                iziToast.success({
                    title: 'Success',
                    message: "{{ session('success') }}",
                    position: 'topRight',
                    close: true,
                    progressBar: true,
                    timeout: 3000
                });
            @endif

            @if(session('error'))
                iziToast.error({
                    title: 'Error',
                    message: "{{ session('error') }}",
                    position: 'topRight',
                    close: true,
                    progressBar: true,
                    timeout: 3000
                });
            @endif
        });
    </script>
</body>
</html> 