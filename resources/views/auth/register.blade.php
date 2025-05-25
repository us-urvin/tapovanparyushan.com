@extends('layouts.auth')

@section('content')
<h1 class="text-2xl font-bold text-center text-[#1A2B49] mb-6">Sign Up to your account</h1>
<form>
    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Shangh Name <span class="text-red-500">*</span></label>
        <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter your Shangh name">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 mb-1">Enter Address of Shangh <span class="text-red-500">*</span></label>
        <textarea class="w-full border border-gray-300 rounded-lg px-4 py-2 h-24 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter address of shangh..."></textarea>
    </div>
    <div class="flex gap-4 mb-4">
        <div class="w-1/2">
            <label class="block text-gray-700 mb-1">Trustee Name <span class="text-red-500">*</span></label>
            <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter trustee name">
        </div>
        <div class="w-1/2">
            <label class="block text-gray-700 mb-1">Trustee Email <span class="text-red-500">*</span></label>
            <input type="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter trustee email">
        </div>
    </div>
    <div class="mb-6">
        <label class="block text-gray-700 mb-1">Reason/Note</label>
        <textarea class="w-full border border-gray-300 rounded-lg px-4 py-2 h-20 focus:outline-none focus:ring-2 focus:ring-[#C9A14A] placeholder:text-gray-400" placeholder="Enter reason/note..."></textarea>
    </div>
    <button type="submit" class="w-full bg-[#C9A14A] text-white py-2 rounded-lg font-semibold flex items-center justify-center gap-2 hover:bg-[#b38e3c] transition mb-4">
        Submit
        <span class="ml-2">&rarr;</span>
    </button>
</form>
<div class="mt-2 text-center text-gray-600">
    Have an account?
    <a href="{{ route('login') }}" class="text-[#C9A14A] font-semibold">Sign in</a>
</div>
@endsection 