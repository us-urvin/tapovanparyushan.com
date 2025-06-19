@extends('layouts.admin')

@section('title', 'Event Details')
@section('page-title', 'Event Details')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="text-2xl font-semibold text-[#1A2B49] flex items-center gap-2">
        Event Details
        <span class="ml-2 bg-[#F3E6C7] text-[#C9A14A] text-xs font-semibold px-3 py-1 rounded" id="eventCount"></span>
    </div>
    <div class="flex gap-2">
        <button id="filterBtn" class="flex items-center gap-2 border border-[#C9A14A] text-[#C9A14A] font-semibold px-4 py-2 rounded-lg hover:bg-[#F3E6C7] transition">
            <i class="fas fa-filter"></i> Filter
        </button>
        @if (!auth()->user()->hasRole('Center'))
            <a href="{{ route('sangh.paryushan.events.create') }}" class="bg-[#C9A14A] text-white font-semibold px-6 py-2 rounded-lg flex items-center gap-2 hover:bg-[#b38e3c] transition">
                <span>+ Apply For {{ \Carbon\Carbon::now()->year }} Payushan</span>
            </a>            
        @endif
    </div>
</div>

<div id="filterSection" class="hidden mb-6 bg-white rounded-lg shadow p-4">
    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Select Event</label>
            <select id="eventFilter" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]">
                <option value="">All Events</option>
            </select>
        </div>
        <div class="flex items-end gap-2">
            <button id="applyFilter" class="bg-[#C9A14A] text-white font-semibold px-6 py-2 rounded-lg hover:bg-[#b38e3c] transition">
                Apply Filter
            </button>
            <button id="resetFilter" class="border border-gray-300 text-gray-600 font-semibold px-6 py-2 rounded-lg hover:bg-gray-50 transition">
                Reset
            </button>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-4 flex justify-between items-center">
        <input type="text" id="searchInput" class="w-1/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" placeholder="Search Event Year">
    </div>
    <div class="overflow-x-auto datatable-theme-box">
        <table id="eventTable" class="min-w-full text-sm text-left">
            <thead class="bg-[#F8F5ED] text-[#1A2B49]">
                <tr>
                    @if(Auth::user()->hasRole('Admin'))
                    <th>Sangh Name</th>
                    @endif
                    <th>Event</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Country</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
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
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
<script>
    window.isAdmin = {{ Auth::user()->hasRole('Admin') ? 'true' : 'false' }};
    window.csrfToken = '{{ csrf_token() }}';
    window.eventYears = @json(\App\Constants\Constants::EVENT_YEAR);
</script>
<script src="{{ asset('js/paryushan-event.js') }}"></script>
@endpush 