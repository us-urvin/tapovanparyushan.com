@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="text-center text-2xl text-[#1A2B49] font-semibold py-20">
    @if (auth()->user()->hasRole('Admin'))
        Welcome to the Admin Dashboard
    @else 
        Welcome to the Sangh Dashboard
    @endif 
</div>
@endsection 