@extends('layouts.auth')

@section('content')
<h1 class="text-2xl font-bold text-center text-[#1A2B49] mb-6">Sign in to your account</h1>
<form id="shanghLoginForm" action="{{ route('login.send-otp') }}" method="POST" class="items-center">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Pincode</label>
        <input type="text" name="pincode" id="pincode" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter Pincode">
        <div id="pincodeError" class="text-red-600 text-xs mt-1 hidden"></div>
    </div>
    <div id="userInfo" class="hidden mb-6">
        <div class="flex justify-between mb-4 text-sm">
            <div>
                <span class="text-gray-500">Name of Shree Sangh</span>
                <div id="shanghName" class="font-semibold"></div>
            </div>
            <div>
                <span class="text-gray-500">Name of Trustee</span>
                <div id="trusteeName" class="font-semibold"></div>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Email</label>
            <div id="email" class="font-semibold"></div>
        </div>
    </div>
    <div class="mb-6">
        <label class="block text-gray-700 mb-1">Mobile Number</label>
        <input type="text" name="mobile" id="mobile" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter Mobile Number">
        <div id="mobileError" class="text-red-600 text-xs mt-1 hidden"></div>
        @error('mobile')
            <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="flex justify-center mb-6">
        <button id="sendOtpBtn" type="submit" class="w-40 bg-[#C9A14A] text-white py-2 rounded-full font-semibold flex justify-center gap-2 hover:bg-[#b38e3c] transition">
            <span id="sendOtpBtnText">Send OTP</span>
            <svg id="sendOtpBtnLoader" class="w-5 h-5 animate-spin hidden" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="#fff" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
        </button>
    </div>
</form>

@push('scripts')
<script src="{{ asset('js/login.js') }}"></script>
@endpush
@endsection 