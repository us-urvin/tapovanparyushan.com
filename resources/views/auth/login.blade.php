@extends('layouts.auth')

@section('content')
<h1 class="text-2xl font-bold text-center text-[#1A2B49] mb-6">Sign in to your account</h1>
<form id="shanghLoginForm">
    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Pincode</label>
        <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter Pincode">
    </div>
    <div class="flex justify-between mb-4 text-sm">
        <div>
            <span class="text-gray-500">Name of Shree Sangh</span>
            <div class="font-semibold">Happy Singh</div>
        </div>
        <div>
            <span class="text-gray-500">Name of Trustee</span>
            <div class="font-semibold">Raj Sheth</div>
        </div>
    </div>
    <div class="mb-6">
        <label class="block text-gray-700 mb-1">Mobile Number</label>
        <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter Mobile Number">
    </div>
    <button id="shanghLoginBtn" type="submit" class="w-full bg-[#C9A14A] text-white py-2 rounded-lg font-semibold flex items-center justify-center gap-2 hover:bg-[#b38e3c] transition">
        <span id="shanghLoginBtnText">Send OTP</span>
        <svg id="shanghLoginBtnLoader" class="w-5 h-5 animate-spin hidden" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="#fff" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
    </button>
</form>
<div class="mt-6 text-center text-gray-600">
    Don't have an account?
    <a href="{{ route('register') }}" class="text-[#C9A14A] font-semibold">Sign Up</a>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('shanghLoginForm').addEventListener('submit', function() {
            const btn = document.getElementById('shanghLoginBtn');
            const loader = document.getElementById('shanghLoginBtnLoader');
            const text = document.getElementById('shanghLoginBtnText');
            btn.disabled = true;
            loader.classList.remove('hidden');
            text.textContent = 'Sending...';
        });
    });
</script>
@endsection 