@extends('layouts.auth')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[60vh] w-full">
    <div class="flex flex-col items-center w-full">
        <img src="{{ asset('images/logo.png') }}" alt="Tapovan Paryushan Aradhana" class="w-32 h-32 mb-6">
        <h2 class="text-xl md:text-2xl font-bold text-center text-[#1A2B49] mb-2">Please enter the One-Time Password to verify your account</h2>
        <p class="text-gray-500 text-center mb-8">A One-Time Password has been sent to <span class="font-semibold">9876545123</span></p>
        <form class="w-full flex flex-col items-center">
            <div class="flex space-x-4 mb-8">
                <input type="text" maxlength="1" class="w-12 h-12 text-center border-b-2 border-gray-300 focus:border-[#C9A14A] text-2xl outline-none" />
                <input type="text" maxlength="1" class="w-12 h-12 text-center border-b-2 border-gray-300 focus:border-[#C9A14A] text-2xl outline-none" />
                <input type="text" maxlength="1" class="w-12 h-12 text-center border-b-2 border-gray-300 focus:border-[#C9A14A] text-2xl outline-none" />
                <input type="text" maxlength="1" class="w-12 h-12 text-center border-b-2 border-gray-300 focus:border-[#C9A14A] text-2xl outline-none" />
            </div>
            <button type="submit" class="w-40 bg-[#C9A14A] text-white py-2 rounded-full font-semibold flex items-center justify-center gap-2 hover:bg-[#b38e3c] transition mb-6">
                Submit
                <svg class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24"><path stroke="#fff" stroke-width="2" d="M5 12h14m0 0l-4-4m4 4l-4 4" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        </form>
        <div class="text-center mt-2">
            <button class="text-sm text-[#1A2B49] font-semibold hover:underline">Resend One-Time Password</button>
            <div class="text-xs text-gray-400 mt-2">
                Entered a wrong number?
            </div>
        </div>
    </div>
</div>
@endsection 