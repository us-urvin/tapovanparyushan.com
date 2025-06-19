@extends('layouts.auth')

@section('content')
<h1 class="text-2xl font-bold text-center text-[#1A2B49] mb-6">
    @if(request()->is('center/*'))
        Center Login
    @else
        Admin Login
    @endif
</h1>
@if(session('error'))
    <div class="mb-4 text-red-600 text-sm">{{ session('error') }}</div>
@endif
<form method="POST" action="{{ route('admin.login.post') }}" id="adminLoginForm">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Email</label>
        <input name="email" value="{{ old('email') }}" type="email" class="w-full border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter Email" data-error="email_error">
        @error('email')
            <div class="text-red-600 text-xs mt-1 error-message" id="email_error">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-6">
        <label class="block text-gray-700 mb-1">Password</label>
        <input name="password" type="password" class="w-full border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter Password" data-error="password_error">
        @error('password')
            <div class="text-red-600 text-xs mt-1 error-message" id="password_error">{{ $message }}</div>
        @enderror
    </div>
    @if(request()->is('center/*'))
        <input type="hidden" name="center" value="1" />
    @endif
    <button id="adminLoginBtn" type="submit" class="w-full bg-[#C9A14A] text-white py-2 rounded-lg font-semibold flex items-center justify-center gap-2 hover:bg-[#b38e3c] transition">
        <span id="adminLoginBtnText">Login</span>
        <svg id="adminLoginBtnLoader" class="w-5 h-5 animate-spin hidden" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="#fff" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
    </button>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('#adminLoginForm [data-error]').forEach(function(input) {
            input.addEventListener('input', function() {
                var errorId = input.getAttribute('data-error');
                var errorDiv = document.getElementById(errorId);
                if (errorDiv) {
                    errorDiv.style.display = 'none';
                }
                // Remove red border if present
                input.classList.remove('border-red-500');
                input.classList.add('border-gray-300');
            });
        });
        document.getElementById('adminLoginForm').addEventListener('submit', function() {
            const btn = document.getElementById('adminLoginBtn');
            const loader = document.getElementById('adminLoginBtnLoader');
            const text = document.getElementById('adminLoginBtnText');
            btn.disabled = true;
            loader.classList.remove('hidden');
            text.textContent = 'Logging in...';
        });
    });
</script>
@endsection 