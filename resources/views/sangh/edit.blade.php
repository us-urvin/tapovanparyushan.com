@extends('layouts.admin')

@section('title', 'Add Sangh Profile')
@section('page-title', 'Add Sangh Profile')

@section('content')
<div class="min-h-screen bg-[#F8F5ED] p-4">
    <div class="mx-auto">
        <!-- Stepper -->
        <div class="flex items-center justify-between mb-8">
            <!-- Step 1: Active -->
            <div class="stepper-step flex flex-col items-center flex-1 cursor-pointer" data-step="1">
                <div class="relative flex items-center justify-center">
                    <div class="step-circle w-8 h-8 rounded-full border-2 border-[#C9A14A] flex items-center justify-center bg-[#FFFCF5]">
                        <div class="w-3 h-3 rounded-full bg-[#C9A14A]"></div>
                    </div>
                </div>
                <div class="step-text mt-2 text-xs font-semibold text-[#C9A14A] text-center">General<br>Information</div>
            </div>
            <!-- Line -->
            <div class="step-line flex-1 h-0.5 bg-[#E5E5E5] mx-2"></div>
            <!-- Step 2: Inactive -->
            <div class="stepper-step flex flex-col items-center flex-1 cursor-pointer" data-step="2">
                <div class="relative flex items-center justify-center">
                    <div class="step-circle w-8 h-8 rounded-full border-2 border-[#E5E5E5] flex items-center justify-center bg-[#FFFCF5]">
                        <div class="w-3 h-3 rounded-full bg-black"></div>
                    </div>
                </div>
                <div class="step-text mt-2 text-xs font-semibold text-black text-center">Other Sangh<br>Information</div>
            </div>
            <!-- Line -->
            <div class="step-line flex-1 h-0.5 bg-[#E5E5E5] mx-2"></div>
            <!-- Step 3: Inactive -->
            <div class="stepper-step flex flex-col items-center flex-1 cursor-pointer" data-step="3">
                <div class="relative flex items-center justify-center">
                    <div class="step-circle w-8 h-8 rounded-full border-2 border-[#E5E5E5] flex items-center justify-center bg-[#FFFCF5]">
                        <div class="w-3 h-3 rounded-full bg-black"></div>
                    </div>
                </div>
                <div class="step-text mt-2 text-xs font-semibold text-black text-center">Transportation<br>Availability</div>
            </div>
        </div>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form id="sanghForm" action="{{ route('sangh.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <input type="hidden" name="sangh_id" value="{{ $sangh->id }}">
            <!-- Include Step 1 Content -->
            @include('sangh.steps.step1')

            <!-- Step 2 Content -->
            @include('sangh.steps.step2')

            <!-- Step 3 Content -->
            @include('sangh.steps.step3')
        </form>
    </div>
</div>

@push('scripts')
<script>
    window.PARTICULARS = @json(App\Constants\Constants::PARTICULARS);
</script>
<script src="{{ asset('js/sangh-edit.js') }}"></script>
@endpush
@endsection 