@extends('layouts.auth')

@push('style')
    <style>
        .toggle-switch-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        .toggle-switch {
            position: relative;
            display: flex;
            align-items: center;
            width: auto;
            background-color: #E5E0D8;
            border-radius: 9999px;
            padding: 6px;
            cursor: pointer;
        }
        .toggle-switch-handle {
            position: absolute;
            top: 6px;
            left: 6px;
            height: 40px;
            background-color: #C9A14A;
            border-radius: 9999px;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            box-shadow: 0 1px 5px rgba(0,0,0,0.1);
        }
        .toggle-switch-label {
            position: relative;
            z-index: 1;
            padding: 0 20px;
            line-height: 40px;
            font-weight: 600;
            color: #1A2B49;
            transition: color 0.3s ease;
            white-space: nowrap;
        }
        input[type="radio"] {
            display: none;
        }
        input[type="radio"]:checked + .toggle-switch-label {
            color: white;
        }

        /* Select2 Custom Styling */
        .select2-container--default .select2-selection--single {
            background-color: transparent !important;
            border: none !important;
            border-bottom: 2px solid #d1d5db !important;
            border-radius: 0 !important;
            padding: 0.5rem 0 !important;
            height: auto !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default .select2-selection--single:focus,
        input:focus {
            border-bottom-color: #C9A14A !important;
            outline: none !important;
            box-shadow: none !important;
        }
        
        input[name="pincode"]:not(:placeholder-shown) {
            background-color: #eef3ff;
            border-bottom-color: #C9A14A;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #111827 !important;
            padding: 0 !important;
            line-height: 1.5 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #6b7280 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100% !important;
            right: 0 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #6b7280 transparent transparent transparent !important;
        }

        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent #6b7280 transparent !important;
        }

        .select2-dropdown {
            border: 1px solid #e5e7eb !important;
            border-radius: 0.5rem !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
        }

        .select2-container--default .select2-results__option--highlighted {
            background-color: #F8F5ED !important;
            color: #1A2B49 !important;
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #f3f4f6 !important;
            color: #1A2B49 !important;
        }

        /* Style the search input within the dropdown */
        .select2-search--dropdown .select2-search__field {
            border-radius: 0.375rem !important;
            border: 1px solid #d1d5db !important;
            color: #1A2B49 !important;
        }

        .select2-search--dropdown .select2-search__field:focus {
            outline: none !important;
            border-color: #C9A14A !important;
            box-shadow: 0 0 0 1px #C9A14A !important;
        }

        /* Floating label for Select2 */
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #6b7280 !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--single {
            border-bottom-color: #C9A14A !important;
        }
        .info-item {
            opacity: 1;
            transform: none;
            transition: none;
        }
        .dropdown-wrapper {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transform: translateY(-10px);
        }

        .dropdown-wrapper.visible {
            max-height: 150px;
            opacity: 1;
            transform: translateY(0);
        }
    </style>
@endpush

@section('content')
<div class="text-center mb-6">
    <h2 class="text-2xl font-bold text-[#1A2B49]">Sign In to your account</h2>
    <p class="text-gray-500 mt-2">Please find your Sangh by</p>
</div>

<form id="shanghLoginForm" action="{{ route('login.send-otp') }}" method="POST" class="space-y-6">
    @csrf

    <!-- Search Mode Toggle -->
    <div class="toggle-switch-wrapper">
        <div class="toggle-switch">
            <input type="radio" name="searchMode" value="pincode" id="searchByPincode" checked>
            <label for="searchByPincode" class="toggle-switch-label">Pincode</label>
            <input type="radio" name="searchMode" value="city" id="searchByCity">
            <label for="searchByCity" class="toggle-switch-label">City/Village</label>
            <div class="toggle-switch-handle" id="toggleHandle"></div>
        </div>
    </div>
    
    <!-- Floating Label Inputs -->
    <div class="relative form-input-group mb-4" id="pincodeInputWrapper">
        <input type="text" name="pincode" id="pincode" maxlength="6" placeholder="Enter Pincode"
            class="block w-full px-4 py-2 text-base text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#C9A14A]">
        <div id="pincodeError" class="text-red-600 text-xs mt-1 hidden"></div>
    </div>

    <div id="districtDropdownWrapper" class="relative dropdown-wrapper mb-4 hidden">
        <select id="districtDropdown" class="w-full">
            <option></option>
        </select>
        <div id="districtError" class="text-red-600 text-xs mt-1"></div>
    </div>
    
    <div id="sanghDropdownWrapper" class="relative dropdown-wrapper mb-4 hidden">
        <select id="sanghDropdown" class="w-full" disabled>
            <option></option>
        </select>
        <div id="sanghError" class="text-red-600 text-xs mt-1"></div>
    </div>

    <!-- Sangh Info -->
    <div id="userInfo" class="hidden pt-4">
        <div class="bg-[#F8F5ED] rounded-lg shadow p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div class="info-item mb-4 md:mb-0">
                    <p class="text-sm text-gray-500 mb-1">Name of Shree Sangh</p>
                    <p id="shanghName" class="font-semibold text-[#1A2B49] text-base"></p>
                </div>
                <div class="info-item">
                    <p class="text-sm text-gray-500 mb-1">Name of Trustee</p>
                    <p id="trusteeName" class="font-semibold text-[#1A2B49] text-base"></p>
                </div>
            </div>
            <div class="info-item mb-4">
                <p class="text-sm text-gray-500 mb-1">Email</p>
                <p id="email" class="font-semibold text-[#1A2B49] text-base"></p>
            </div>
            <div class="info-item">
                <p class="text-sm text-gray-500 mb-1">Mobile</p>
                <p id="mobileInfo" class="font-semibold text-[#1A2B49] text-base"></p>
            </div>
        </div>
    </div>

    <input type="hidden" name="mobile" id="hiddenMobile">

    <!-- Submit Button -->
    <div class="flex justify-center pt-4">
        <button id="sendOtpBtn" type="submit" class="w-full bg-[#C9A14A] text-white py-3 rounded-lg font-semibold flex justify-center items-center gap-2 hover:bg-[#b38e3c] transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#C9A14A]">
            <span id="sendOtpBtnText">Send OTP</span>
            <svg id="sendOtpBtnLoader" class="w-5 h-5 animate-spin hidden" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="#fff" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
        </button>
    </div>
</form>

<div class="text-center mt-6">
    <p class="text-sm text-gray-600">
        Is your Sangh not registered?
        <a href="{{ route('register') }}" class="font-semibold text-[#C9A14A] hover:underline">
            Sign up here
        </a>
    </p>
</div>
@endsection

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('js/login.js') }}"></script>
@endpush 