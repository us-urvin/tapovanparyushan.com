@extends('layouts.auth')

@section('content')
<h1 class="text-2xl font-bold text-center text-[#1A2B49] mb-6">Sign Up to your account</h1>
<form method="POST" action="{{ route('register.post') }}" id="registerForm" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Sangh Name <span class="text-red-500">*</span></label>
        <input name="sangh_name" value="{{ old('sangh_name') }}" type="text" 
        class="w-full border {{ $errors->has('sangh_name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter your Sangh name" data-error="shangh_name_error">
        @error('sangh_name')
            <div class="text-red-600 text-xs mt-1 error-message" id="shangh_name_error">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Enter Address of Sangh <span class="text-red-500">*</span></label>
        <textarea name="sangh_address" 
        class="w-full border {{ $errors->has('sangh_address') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2 h-24 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter address of sangh..." data-error="sangh_address_error">{{ old('sangh_address') }}</textarea>
        @error('sangh_address')
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
    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Reason/Note</label>
        <textarea name="reason_note" class="w-full border {{ $errors->has('reason_note') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2 h-20 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter reason/note..." data-error="reason_note_error">{{ old('reason_note') }}</textarea>
        @error('reason_note')
            <div class="text-red-600 text-xs mt-1 error-message" id="reason_note_error">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4 flex flex-col items-start">
        <label class="flex items-center px-4 py-2 border border-gray-300 rounded cursor-pointer hover:bg-gray-50 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 16V4m0 0l-4 4m4-4l4 4M4 20h16" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span>Upload a Document</span>
            <input type="file" name="document" class="hidden" id="documentInput" />
        </label>
        <span id="selectedFileName" class="text-sm text-gray-600 mt-2"></span>
    </div>
    <input type="hidden" name="mobile" value="{{ request()->get('mobile') }}">
    <button id="registerBtn" type="submit" class="w-full bg-[#C9A14A] text-white py-2 rounded-lg font-semibold flex items-center justify-center gap-2 hover:bg-[#b38e3c] transition mb-4">
        <span id="registerBtnText">Submit</span>
        <svg id="registerBtnLoader" class="w-5 h-5 animate-spin hidden" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="#fff" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
    </button>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('#registerForm [data-error]').forEach(function(input) {
            input.addEventListener('input', function() {
                var errorId = input.getAttribute('data-error');
                var errorDiv = document.getElementById(errorId);
                if (errorDiv) {
                    errorDiv.style.display = 'none';
                }
                input.classList.remove('border-red-500');
                input.classList.add('border-gray-300');
            });
        });

        const documentInput = document.getElementById('documentInput');
        const selectedFileName = document.getElementById('selectedFileName');

        documentInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                selectedFileName.textContent = 'Selected file: ' + this.files[0].name;
            } else {
                selectedFileName.textContent = '';
            }
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