@extends('layouts.admin')

@section('title', 'Centers')
@section('page-title', 'Centers')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="text-2xl font-semibold text-[#1A2B49]">Centers</div>
    <button id="addCenterBtn" class="bg-[#C9A14A] text-white font-semibold px-6 py-2 rounded-lg flex items-center gap-2 hover:bg-[#b38e3c] transition">
        <span>+ Add Center</span>
    </button>
</div>
<div class="datatable-theme-box">
    <div class="mb-4 flex justify-between items-center">
        <input type="text" id="searchCenterInput" class="w-1/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" placeholder="Search Center">
    </div>
    <div class="overflow-x-auto datatable-theme-box">
        <table id="centersTable" class="min-w-full text-sm text-left">
            <thead class="bg-[#F8F5ED] text-[#1A2B49]">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Center Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <!-- DataTables info and pagination will be auto-inserted -->
</div>
<!-- Add/Edit Modal Placeholder -->
<div id="centerModal" class="fixed inset-0 z-50 flex items-center justify-center bg-[#F3E6C7]/70 backdrop-blur-sm hidden transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 pt-12 pr-12 relative animate-fadeIn">
        <!-- Close button outside top-right -->
        <button id="closeCenterModal" class="absolute top-4 right-4 bg-white rounded-full shadow p-3 text-gray-400 hover:text-gray-600 focus:outline-none z-10">
            <i class="fas fa-times text-xl"></i>
        </button>
        <h3 id="centerModalTitle" class="text-lg font-semibold text-[#1A2B49] mb-4">Add Center</h3>
        <form id="centerForm">
            <input type="hidden" name="center_id" id="center_id">
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Name</label>
                <input type="text" name="name" id="center_name_input" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" placeholder="Enter Name">
                <div class="text-red-600 text-xs mt-1 hidden" id="nameError"></div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="center_email_input" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" placeholder="Enter Email">
                <div class="text-red-600 text-xs mt-1 hidden" id="emailError"></div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Mobile Number</label>
                <input type="text" name="mobile" id="center_mobile_input" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" placeholder="Enter Mobile Number">
                <div class="text-red-600 text-xs mt-1 hidden" id="mobileError"></div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Center Name</label>
                <input type="text" name="center_name" id="center_center_name_input" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" placeholder="Enter Center Name">
                <div class="text-red-600 text-xs mt-1 hidden" id="centerNameError"></div>
            </div>
            <div id="centerPasswordBlock" class="mb-4 hidden">
                <label class="block text-gray-700 mb-1">Password</label>
                <div class="flex items-center gap-2">
                    <input type="text" id="centerPasswordDisplay" class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100" readonly>
                    <button type="button" id="copyCenterPassword" class="bg-[#C9A14A] text-white px-3 py-1 rounded hover:bg-[#b38e3c]" title="Copy"><i class="fas fa-copy"></i></button>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" id="centerFormSubmit" class="bg-[#C9A14A] text-white px-6 py-2 rounded-full font-semibold hover:bg-[#b38e3c] transition flex items-center gap-2">
                    <span id="centerFormBtnText">Save</span>
                    <svg id="centerFormBtnLoader" class="w-5 h-5 animate-spin hidden" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="#fff" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    body, .bg-[#F8F5ED] { background: #F8F5ED !important; }
    div.dataTables_filter { display: none !important; }
    .datatable-theme-box {
        background: #F8F5ED;
        border-radius: 1rem;
        box-shadow: 0 4px 24px 0 rgba(201,161,74,0.10);
        padding: 2rem 1rem 1rem 1rem;
        margin-top: 1.5rem;
    }
    table.dataTable {
        background: #F8F5ED;
        border-radius: 0.75rem;
        border: 1px solid #E5E0D8;
        margin-top: 0;
    }
    table.dataTable thead th {
        background: #F3E6C7;
        color: #1A2B49;
        font-weight: 700;
        border-bottom: 2px solid #E5E0D8;
        padding: 1rem 0.5rem;
    }
    table.dataTable tbody td {
        background: #F8F5ED;
        color: #1A2B49;
        padding: 1rem 0.5rem;
        border-bottom: 1px solid #E5E0D8;
    }
    table.dataTable tbody tr {
        transition: background 0.2s;
    }
    table.dataTable tbody tr:hover {
        background: #F3E6C7;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        background: #F3E6C7;
        color: #C9A14A !important;
        border-radius: 0.375rem;
        margin: 0 2px;
        border: none;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #C9A14A !important;
        color: #fff !important;
    }
    .dataTables_info {
        color: #1A2B49;
        margin-top: 1rem;
    }
    /* Modal overlay soft */
    #centerModal { background: rgba(243, 230, 199, 0.7) !important; }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn { animation: fadeIn 0.3s ease; }
    #centerModal .bg-white { box-shadow: 0 10px 40px 0 rgba(0,0,0,0.15); }

    #centersTable_length {
        margin-bottom: 10px;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
<script src="{{ asset('js/centers.js') }}"></script>
@endpush 