@extends('layouts.admin')

@section('title', 'Apply for Paryushan')
@section('page-title', 'Apply for Paryushan (year)')

@section('content')
<div class="min-h-screen bg-[#F8F5ED] p-4">
    <div class="mx-auto">
        <!-- Stepper UI -->
        <div class="flex items-center justify-between mb-8">
            <div class="stepper-step flex flex-col items-center flex-1 cursor-pointer" data-step="1">
                <div class="relative flex items-center justify-center">
                    <div class="step-circle w-8 h-8 rounded-full border-2 border-[#C9A14A] flex items-center justify-center bg-[#FFFCF5]">
                        <div class="w-3 h-3 rounded-full bg-[#C9A14A]"></div>
                    </div>
                </div>
                <div class="step-text mt-2 text-xs font-semibold text-[#C9A14A] text-center">Sangh Details</div>
            </div>
            <div class="step-line flex-1 h-0.5 bg-[#E5E5E5] mx-2"></div>
            <div class="stepper-step flex flex-col items-center flex-1 cursor-pointer" data-step="2">
                <div class="relative flex items-center justify-center">
                    <div class="step-circle w-8 h-8 rounded-full border-2 border-[#E5E5E5] flex items-center justify-center bg-[#FFFCF5]">
                        <div class="w-3 h-3 rounded-full bg-black"></div>
                    </div>
                </div>
                <div class="step-text mt-2 text-xs font-semibold text-black text-center">Accommodation Details</div>
            </div>
            <div class="step-line flex-1 h-0.5 bg-[#E5E5E5] mx-2"></div>
            <div class="stepper-step flex flex-col items-center flex-1 cursor-pointer" data-step="3">
                <div class="relative flex items-center justify-center">
                    <div class="step-circle w-8 h-8 rounded-full border-2 border-[#E5E5E5] flex items-center justify-center bg-[#FFFCF5]">
                        <div class="w-3 h-3 rounded-full bg-black"></div>
                    </div>
                </div>
                <div class="step-text mt-2 text-xs font-semibold text-black text-center">Paryushan Specific</div>
            </div>
            <div class="step-line flex-1 h-0.5 bg-[#E5E5E5] mx-2"></div>
            <div class="stepper-step flex flex-col items-center flex-1 cursor-pointer" data-step="4">
                <div class="relative flex items-center justify-center">
                    <div class="step-circle w-8 h-8 rounded-full border-2 border-[#E5E5E5] flex items-center justify-center bg-[#FFFCF5]">
                        <div class="w-3 h-3 rounded-full bg-black"></div>
                    </div>
                </div>
                <div class="step-text mt-2 text-xs font-semibold text-black text-center">Expected Attendance</div>
            </div>
            <div class="step-line flex-1 h-0.5 bg-[#E5E5E5] mx-2"></div>
            <div class="stepper-step flex flex-col items-center flex-1 cursor-pointer" data-step="5">
                <div class="relative flex items-center justify-center">
                    <div class="step-circle w-8 h-8 rounded-full border-2 border-[#E5E5E5] flex items-center justify-center bg-[#FFFCF5]">
                        <div class="w-3 h-3 rounded-full bg-black"></div>
                    </div>
                </div>
                <div class="step-text mt-2 text-xs font-semibold text-black text-center">Regarding Mahatma</div>
            </div>
            <div class="step-line flex-1 h-0.5 bg-[#E5E5E5] mx-2"></div>
            <div class="stepper-step flex flex-col items-center flex-1 cursor-pointer" data-step="6">
                <div class="relative flex items-center justify-center">
                    <div class="step-circle w-8 h-8 rounded-full border-2 border-[#E5E5E5] flex items-center justify-center bg-[#FFFCF5]">
                        <div class="w-3 h-3 rounded-full bg-black"></div>
                    </div>
                </div>
                <div class="step-text mt-2 text-xs font-semibold text-black text-center">Terms & Conditions</div>
            </div>
        </div>
            <form id="paryushanEventForm"
                action="{{ isset($event) ? route('sangh.paryushan.events.update', $event->id) : route('sangh.paryushan.events.store') }}"
                method="POST"
                enctype="multipart/form-data"
                novalidate>
            @if(isset($event))
                @method('PUT')
            @endif
            @csrf
            @include('admin.paryushan.events.steps.step1')
            @include('admin.paryushan.events.steps.step2')
            @include('admin.paryushan.events.steps.step3')
            @include('admin.paryushan.events.steps.step4')
            @include('admin.paryushan.events.steps.step5')
            @include('admin.paryushan.events.steps.step6')
        </form>
    </div>
</div>
@push('scripts')
<script src="{{ asset('js/paryushan-event.js') }}"></script>
@endpush
@endsection 