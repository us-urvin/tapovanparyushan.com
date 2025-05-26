@extends('layouts.auth')

@section('content')
<h1 class="text-2xl font-bold text-center text-[#1A2B49] mb-6">Sign Up to your account</h1>
<form method="POST" action="{{ route('register.post') }}" id="registerForm">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Shangh Name <span class="text-red-500">*</span></label>
        <input name="shangh_name" value="{{ old('shangh_name') }}" type="text" class="w-full border {{ $errors->has('shangh_name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter your Shangh name" data-error="shangh_name_error">
        @error('shangh_name')
            <div class="text-red-600 text-xs mt-1 error-message" id="shangh_name_error">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Enter Address of Shangh <span class="text-red-500">*</span></label>
        <textarea name="shangh_address" class="w-full border {{ $errors->has('shangh_address') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2 h-24 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter address of shangh..." data-error="shangh_address_error">{{ old('shangh_address') }}</textarea>
        @error('shangh_address')
            <div class="text-red-600 text-xs mt-1 error-message" id="shangh_address_error">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Pincode <span class="text-red-500">*</span></label>
        <input name="pincode" value="{{ old('pincode') }}" type="text" class="w-full border {{ $errors->has('pincode') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter Pincode" data-error="pincode_error">
        @error('pincode')
            <div class="text-red-600 text-xs mt-1 error-message" id="pincode_error">{{ $message }}</div>
        @enderror
    </div>
    <div class="flex gap-4 mb-4">
        <div class="w-1/2">
            <label class="block text-gray-700 mb-1">Trustee Name <span class="text-red-500">*</span></label>
            <input name="name" value="{{ old('name') }}" type="text" class="w-full border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter trustee name" data-error="name_error">
            @error('name')
                <div class="text-red-600 text-xs mt-1 error-message" id="name_error">{{ $message }}</div>
            @enderror
        </div>
        <div class="w-1/2">
            <label class="block text-gray-700 mb-1">Trustee Email <span class="text-red-500">*</span></label>
            <input name="email" value="{{ old('email') }}" type="email" class="w-full border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter trustee email" data-error="email_error">
            @error('email')
                <div class="text-red-600 text-xs mt-1 error-message" id="email_error">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-6">
        <label class="block text-gray-700 mb-1">Reason/Note</label>
        <textarea name="reason_note" class="w-full border {{ $errors->has('reason_note') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2 h-20 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter reason/note..." data-error="reason_note_error">{{ old('reason_note') }}</textarea>
        @error('reason_note')
            <div class="text-red-600 text-xs mt-1 error-message" id="reason_note_error">{{ $message }}</div>
        @enderror
    </div>
    <button id="registerBtn" type="submit" class="w-full bg-[#C9A14A] text-white py-2 rounded-lg font-semibold flex items-center justify-center gap-2 hover:bg-[#b38e3c] transition mb-4">
        <span id="registerBtnText">Submit</span>
        <svg id="registerBtnLoader" class="w-5 h-5 animate-spin hidden" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="#fff" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
    </button>
</form>
<div class="mt-2 text-center text-gray-600">
    Have an account?
    <a href="{{ route('login') }}" class="text-[#C9A14A] font-semibold">Sign in</a>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('#registerForm [data-error]').forEach(function(input) {
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
        document.getElementById('registerForm').addEventListener('submit', function() {
            const btn = document.getElementById('registerBtn');
            const loader = document.getElementById('registerBtnLoader');
            const text = document.getElementById('registerBtnText');
            btn.disabled = true;
            loader.classList.remove('hidden');
            text.textContent = 'Submitting...';
        });
    });
</script>
@endsection 