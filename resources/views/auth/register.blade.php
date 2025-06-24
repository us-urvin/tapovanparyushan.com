@extends('layouts.auth')

@push('style')
<style>
    .form-group {
        position: relative;
        margin-bottom: 1.25rem;
    }

    .form-input {
        width: 100%;
        background-color: transparent !important;
        border: none !important;
        border-bottom: 2px solid #d1d5db !important;
        border-radius: 0 !important;
        padding: 0.5rem 0.25rem;
        transition: border-color 0.3s ease;
    }

    .form-input:focus {
        border-bottom-color: #C9A14A !important;
        outline: none !important;
        box-shadow: none !important;
    }
    
    .form-label {
        position: absolute;
        top: 0.5rem;
        left: 0.25rem;
        color: #6b7280;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .form-input:focus + .form-label,
    .form-input:not(:placeholder-shown) + .form-label {
        top: -1.1rem;
        font-size: 0.875rem;
        color: #C9A14A;
    }

    .file-upload-area {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 2px dashed #d1d5db;
        border-radius: 0.5rem;
        padding: 0.5rem;
        cursor: pointer;
        transition: border-color 0.3s ease;
    }
    .file-upload-area:hover {
        border-color: #C9A14A;
    }
    .file-upload-icon {
        width: 2rem;
        height: 2rem;
        color: #C9A14A;
        margin-bottom: 0.75rem;
    }
    .file-upload-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
    }
    .file-upload-subtitle {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.125rem;
    }
</style>
@endpush

@section('content')
<div class="text-center mb-8">
    <h2 class="text-3xl font-bold text-[#1A2B49]">Sign Up to your account</h2>
</div>

<form method="POST" action="{{ route('register.post') }}" id="registerForm" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <input name="sangh_name" id="sangh_name" value="{{ old('sangh_name') }}" type="text" 
        class="w-full form-input" placeholder=" ">
        <label for="sangh_name" class="form-label">Name of Shree Sangh *</label>
        @error('sangh_name')
            <div class="error-message text-red-600 text-xs">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <textarea name="sangh_address" id="sangh_address"
        class="w-full form-input h-12" placeholder=" ">{{ old('sangh_address') }}</textarea>
        <label for="sangh_address" class="form-label">Address of Sangh *</label>
        @error('sangh_address')
            <div class="error-message text-red-600 text-xs">{{ $message }}</div>
        @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
        <div class="form-group">
            <input name="pincode" id="pincode" value="{{ old('pincode') }}" type="text" class="w-full form-input" placeholder=" ">
            <label for="pincode" class="form-label">Pincode *</label>
            @error('pincode')
                <div class="error-message text-red-600 text-xs">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input name="name" id="name" value="{{ old('name') }}" type="text" class="w-full form-input" placeholder=" ">
            <label for="name" class="form-label">Name of Trustee *</label>
            @error('name')
                <div class="error-message text-red-600 text-xs">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="form-group">
        <input name="email" id="email" value="{{ old('email') }}" type="email" class="w-full form-input" placeholder=" ">
        <label for="email" class="form-label">Trustee Email *</label>
        @error('email')
            <div class="error-message text-red-600 text-xs">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <textarea name="reason_note" id="reason_note" class="w-full form-input h-12" placeholder=" ">{{ old('reason_note') }}</textarea>
        <label for="reason_note" class="form-label">Reason/Note (Optional)</label>
        @error('reason_note')
            <div class="error-message text-red-600 text-xs">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="documentInput" class="file-upload-area">
            <svg class="file-upload-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 2v6h6"></path>
            </svg>
            <p class="file-upload-title">Upload Sangh Document</p>
            <p class="file-upload-subtitle">Click to browse or drag and drop</p>
            <span id="selectedFileName" class="text-sm text-green-600 mt-2 font-semibold"></span>
            <input type="file" name="document" class="hidden" id="documentInput" />
        </label>
         @error('document')
            <div class="error-message text-red-600 text-xs">{{ $message }}</div>
        @enderror
    </div>

    <input type="hidden" name="mobile" value="{{ request()->get('mobile') }}">
    
    <div class="pt-2">
        <button id="registerBtn" type="submit" class="w-full bg-[#C9A14A] text-white py-3 rounded-lg font-semibold flex items-center justify-center gap-2 hover:bg-[#b38e3c] transition-all duration-300">
            <span id="registerBtnText">Submit</span>
            <svg id="registerBtnLoader" class="w-5 h-5 animate-spin hidden" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="#fff" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
        </button>
    </div>
</form>

<div class="text-center mt-6">
    <p class="text-sm text-gray-600">
        Already have an account?
        <a href="{{ route('login') }}" class="font-semibold text-[#C9A14A] hover:underline">
            Sign In here
        </a>
    </p>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const registerForm = document.getElementById('registerForm');
        if (!registerForm) return;

        // --- Logic to clear errors on input ---
        const inputs = registerForm.querySelectorAll('.form-input, #documentInput');
        inputs.forEach(input => {
            const eventType = input.type === 'file' ? 'change' : 'input';
            input.addEventListener(eventType, function() {
                const formGroup = this.closest('.form-group');
                if (formGroup) {
                    const errorDiv = formGroup.querySelector('.error-message');
                    if (errorDiv) {
                        errorDiv.style.display = 'none';
                    }
                }
            });
        });

        // --- File input name display ---
        const documentInput = document.getElementById('documentInput');
        if (documentInput) {
            const selectedFileName = document.getElementById('selectedFileName');
            documentInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    selectedFileName.textContent = this.files[0].name;
                } else {
                    selectedFileName.textContent = '';
                }
            });
        }

        // --- Form submission animation ---
        registerForm.addEventListener('submit', function() {
            const btn = document.getElementById('registerBtn');
            const loader = document.getElementById('registerBtnLoader');
            const text = document.getElementById('registerBtnText');
            if(btn && loader && text) {
                btn.disabled = true;
                loader.classList.remove('hidden');
                text.textContent = 'Submitting...';
            }
        });
    });
</script>
@endpush 