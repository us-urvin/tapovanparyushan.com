<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | Tapovan Paryushan Aradhana</title>
    @vite('resources/css/app.css')
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar.collapsed {
            width: 4rem;
            padding: 1rem 0.5rem;
        }
        .sidebar.collapsed .nav-text,
        .sidebar.collapsed .logo-text,
        .sidebar.collapsed .user-name {
            display: none;
        }
        .sidebar.collapsed .nav-icon {
            margin-right: 0;
        }
        .sidebar.collapsed .nav-item {
            justify-content: center;
            padding: 0.75rem;
        }
        .sidebar.collapsed .logo-container {
            padding: 0;
            margin-bottom: 2rem;
        }
        .sidebar.collapsed .logo-container img {
            width: 2.5rem;
            height: 2.5rem;
        }
        .main-content {
            transition: all 0.3s ease;
        }
        .main-content.expanded {
            margin-left: 4rem !important;
        }
        .navbar {
            transition: all 0.3s ease;
        }
        .navbar.expanded {
            width: calc(100% - 4rem) !important;
        }
        .nav-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        .nav-item:hover {
            background-color: #F3E6C7;
        }
        .nav-icon {
            width: 1.25rem;
            height: 1.25rem;
            margin-right: 0.75rem;
            color: #C9A14A;
        }
    </style>
</head>
<body class="bg-[#F8F5ED] min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <!-- Fixed Sidebar -->
        <aside id="sidebar" class="sidebar w-64 bg-[#F8F5ED] border-r border-[#E5E0D8] flex flex-col py-6 px-4 fixed h-full">
            <div class="logo-container flex flex-col items-center mb-10">
                <img src="{{ asset('images/logo.png') }}" alt="Tapovan Paryushan Aradhana" class="w-40 h-40">
            </div>
            <nav class="flex-1">
                <ul class="space-y-2">
                    @if (Auth::user()->hasRole('Admin'))
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'bg-[#F3E6C7] text-[#C9A14A]' : 'text-[#1A2B49]' }}">
                                <i class="fas fa-home nav-icon"></i>
                                <span class="nav-text">Dashboard</span>
                            </a>
                        </li>                        
                    @else
                        <li>
                            <a href="{{ route('sangh.dashboard') }}" class="nav-item {{ request()->routeIs('sangh.dashboard') ? 'bg-[#F3E6C7] text-[#C9A14A]' : 'text-[#1A2B49]' }}">
                                <i class="fas fa-home nav-icon"></i>
                                <span class="nav-text">Dashboard</span>
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->hasRole('Shangh'))
                        <li>
                            <a href="{{ route('sangh.profile') }}" class="nav-item {{ request()->is('sangh/profile*') ? 'bg-[#F3E6C7] text-[#C9A14A]' : 'text-[#1A2B49]' }}">
                                <i class="fas fa-users nav-icon"></i>
                                <span class="nav-text">Sangh Profile</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('admin.sangh.index') }}" class="nav-item {{ request()->is('admin/sangh*') ? 'bg-[#F3E6C7] text-[#C9A14A]' : 'text-[#1A2B49]' }}">
                                <i class="fas fa-users nav-icon"></i>
                                <span class="nav-text">Sangh Profile</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('sangh.paryushan.events.index') }}" class="nav-item {{ request()->is('sangh/paryushan/events*') ? 'bg-[#F3E6C7] text-[#C9A14A]' : 'text-[#1A2B49]' }}">
                            <i class="fas fa-clipboard-list nav-icon"></i>
                            @if(Auth::user()->hasRole('Shangh'))
                                <span class="nav-text">Apply for Paryushan</span>
                            @else
                                <span class="nav-text">Events</span>
                            @endif
                        </a>
                    </li>
                    @if (Auth::user()->hasRole('Admin'))
                        <li>
                            <a href="{{ route('admin.profile') }}" class="nav-item {{ request()->routeIs('admin.profile') ? 'bg-[#F3E6C7] text-[#C9A14A]' : 'text-[#1A2B49]' }}">
                                <i class="fas fa-user nav-icon"></i>
                                <span class="nav-text">Profile</span>
                            </a>
                        </li>
                    @endif
                </ul>
                <div class="mt-auto pt-8">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="nav-item w-full text-left">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            <span class="nav-text">Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div id="main-content" class="main-content flex-1 ml-64 flex flex-col h-screen">
            <!-- Fixed Navbar -->
            <header id="navbar" class="navbar flex items-center justify-between bg-[#F8F5ED] px-8 py-4 border-b border-[#E5E0D8] fixed w-[calc(100%-16rem)]">
                <div class="flex items-center gap-4">
                    <button id="sidebar-toggle" class="p-2 rounded-lg hover:bg-[#F3E6C7] focus:outline-none">
                        <i class="fas fa-bars text-[#1A2B49] text-xl"></i>
                    </button>
                    <div class="text-xl font-semibold text-[#1A2B49] flex items-center gap-3">
                        <span>@yield('page-title')</span>
                        @hasSection('sangh-count')
                            <span class="ml-2 bg-[#F3E6C7] text-[#C9A14A] text-xs font-semibold px-3 py-1 rounded">@yield('sangh-count')</span>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button class="relative focus:outline-none mr-2">
                        <svg class="w-6 h-6 text-[#1A2B49]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <span class="absolute -top-1 -right-1 bg-[#C9A14A] text-white text-xs rounded-full px-1.5">2</span>
                    </button>
                    <img src="{{ Auth::user()->profile_image_url }}" alt="User" class="w-8 h-8 rounded-full border-2 border-[#C9A14A]">
                    <span class="font-semibold text-[#1A2B49]">{{ Auth::user()->name }}</span>
                </div>
            </header>

            <!-- Scrollable Content -->
            <main class="flex-1 p-6 mt-16 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('scripts')
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar Toggle Functionality
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const navbar = document.getElementById('navbar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            let isSidebarCollapsed = false;

            sidebarToggle.addEventListener('click', function() {
                isSidebarCollapsed = !isSidebarCollapsed;
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                navbar.classList.toggle('expanded');
                
                // Update toggle button icon
                const icon = sidebarToggle.querySelector('i');
                if (isSidebarCollapsed) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-chevron-right');
                } else {
                    icon.classList.remove('fa-chevron-right');
                    icon.classList.add('fa-bars');
                }
            });

            // Toast Notifications
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