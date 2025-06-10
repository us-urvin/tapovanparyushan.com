@extends('layouts.admin')

@section('title', 'Sangh Profile')
@section('page-title', 'Sangh Profile')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="text-2xl font-semibold text-[#1A2B49]">Sangh Profile
        <span class="ml-2 bg-[#F3E6C7] text-[#C9A14A] text-xs font-semibold px-3 py-1 rounded" id="sanghCount"></span>
    </div>
    <a href="{{ route('admin.sangh.create') }}" id="addSanghBtn" class="bg-[#C9A14A] text-white font-semibold px-6 py-2 rounded-lg flex items-center gap-2 hover:bg-[#b38e3c] transition">
        <span>+ Add Sangh Profile</span>
    </a>
</div>
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-4 flex justify-between items-center">
        <input type="text" id="searchInput" class="w-1/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A14A]" placeholder="Search Sangh">
    </div>
    <div class="overflow-x-auto datatable-theme-box">
        <table id="sanghTable" class="min-w-full text-sm text-left">
            <thead class="bg-[#F8F5ED] text-[#1A2B49]">
                <tr>
                    <th>Sangh Name</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Pincode</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<!-- Add/Edit Modal Placeholder -->
<div id="sanghModal" class="hidden"></div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    body, .bg-[#F8F5ED] { background: #F8F5ED !important; }
    /* Hide default DataTable search */
    div.dataTables_filter { display: none !important; }
    /* DataTable wrapper and table theme */
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
$(function() {
    var table = $('#sanghTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('admin.sangh.datatable') }}',
            data: function(d) {
                d.search = $('#searchInput').val();
            }
        },
        columns: [
            { data: 'sangh_name', name: 'sangh_name' },
            { data: 'email', name: 'email' },
            { data: 'name', name: 'name' },
            { data: 'pincode', name: 'pincode' },
            { data: 'status_dropdown', name: 'status', orderable: false, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        drawCallback: function(settings) {
            $('#sanghCount').text(settings._iRecordsTotal + ' Sangh');
        },
        dom: 'rtip'
    });
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });
    // Add/Edit/Delete/Status change JS will go here
    $(document).on('change', '.statusDropdown', function() {
        var userId = $(this).data('user-id');
        var status = $(this).val();
        $.post({
            url: '/admin/sangh/' + userId + '/status',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(res) {
                iziToast.success({ title: 'Success', message: 'Status updated!' });
                table.ajax.reload(null, false);
            },
            error: function() {
                iziToast.error({ title: 'Error', message: 'Failed to update status.' });
            }
        });
    });
    $(document).on('click', '.deleteSanghBtn', function() {
        var userId = $(this).data('user-id');
        iziToast.question({
            timeout: 20000,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            title: 'Delete Confirmation',
            message: 'Are you sure you want to delete this Sangh?',
            position: 'center',
            buttons: [
                ['<button><b>YES</b></button>', function (instance, toast) {
                    $.ajax({
                        url: '/admin/sangh/' + userId,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(res) {
                            iziToast.success({ title: 'Deleted', message: 'Sangh deleted successfully.' });
                            $('#sanghTable').DataTable().ajax.reload(null, false);
                        },
                        error: function() {
                            iziToast.error({ title: 'Error', message: 'Failed to delete Sangh.' });
                        }
                    });
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                }, true],
                ['<button>Cancel</button>', function (instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                }]
            ]
        });
    });
    $(document).on('click', '.editSanghBtn', function() {
        var userId = $(this).data('user-id');
        // TODO: Open edit modal and load form via AJAX
        iziToast.info({ title: 'Edit', message: 'Edit modal coming soon.' });
    });
    $(document).on('click', '.viewSanghBtn', function() {
        var userId = $(this).data('user-id');
        // TODO: Open view modal and load details via AJAX
        iziToast.info({ title: 'View', message: 'View modal coming soon.' });
    });
});
</script>
@endpush 