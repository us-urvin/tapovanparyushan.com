@extends('layouts.admin')

@section('title', 'Event Details')
@section('page-title', 'Event Details')

@section('content')
<div class="bg-[#F8F5ED] min-h-screen p-6">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
        <div class="text-2xl font-semibold text-[#1A2B49] mb-2 md:mb-0">
            Event ID: {{ $event->id }}
        </div>
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            @if(Auth::user()->hasRole('Admin'))
                <!-- Assignment Status Icon Trigger -->
                @if($event->centerAssignments->count())
                    <button id="centerStatusBtn" class="flex items-center gap-2 px-3 py-2 rounded bg-[#F3E6C7] hover:bg-[#e2d2a7] transition">
                        <span class="font-semibold text-sm">Sub Admin Status</span>
                        <!-- Show a colored dot if any assignment is not pending -->
                        @php
                            $hasAccepted = $event->centerAssignments->contains('status', 'accepted');
                            $hasRejected = $event->centerAssignments->contains('status', 'rejected');
                        @endphp
                        @if($hasAccepted)
                            <span title="Accepted" class="w-3 h-3 rounded-full bg-blue-500 inline-block"></span>
                        @elseif($hasRejected)
                            <span title="Rejected" class="w-3 h-3 rounded-full bg-red-500 inline-block"></span>
                        @else
                            <span title="Pending" class="w-3 h-3 rounded-full bg-yellow-500 inline-block"></span>
                        @endif
                    </button>
                @endif
                <!-- Assignment Dropdown: Only show if event is approved -->
                @if($event->status == 1)
                <select class="assing-to bg-white border border-[#F3E6C7] px-4 py-2 rounded-lg font-semibold focus:ring-2 focus:ring-[#C9A14A] focus:outline-none transition" data-id="{{ $event->id }}">
                    <option value="">Assing To Sub Admin</option>
                    @foreach ($centers as $center => $id)
                        @php
                            $assignment = $event->centerAssignments->where('center_id', $id)->first();
                        @endphp
                        <option value="{{ $id }}" @if($assignment && in_array($assignment->status, ['pending','accepted'])) selected @endif>{{ $center }}</option>
                    @endforeach
                </select>
                @endif
                <select class="status-select bg-white border border-[#F3E6C7] px-4 py-2 rounded-lg font-semibold focus:ring-2 focus:ring-[#C9A14A] focus:outline-none transition" data-id="{{ $event->id }}">
                    <option value="0" {{ $event->status == 0 ? 'selected' : '' }}>Pending</option>
                    <option value="1" {{ $event->status == 1 ? 'selected' : '' }}>Approved</option>
                    <option value="2" {{ $event->status == 2 ? 'selected' : '' }}>Rejected</option>
                </select>
            @endif
            <a href="{{ route('sangh.paryushan.events.download-pdf', $event->id) }}" class="bg-black text-white px-5 py-2 rounded-lg font-semibold">Download PDF</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Sangh Details -->
        <div class="bg-white border border-[#F3E6C7] rounded-xl p-6 flex flex-col gap-2">
            <div class="font-semibold text-xl mb-6">Sangh Details</div>
            <div class="grid grid-cols-2 gap-y-6 gap-x-8">
                <div>
                    <div class="text-[#666] text-base">Name of Shree Sangh</div>
                    <div class="font-semibold text-lg mt-1">{{ $event->sangh->sangh_name ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-[#666] text-base">Location</div>
                    <div class="font-semibold text-lg mt-1">{{ $event->sangh->city ?? '-' }}</div>
                </div>
                <div class="col-span-2">
                    <div class="text-[#666] text-base">Event</div>
                    <div class="font-semibold text-lg mt-1">Paryushan {{ $event->event_year }} (Vikram samvat {{ $event->event_year ? $event->event_year + 57 : '-' }})</div>
                </div>
            </div>
        </div>
        <!-- Other Sangh Information -->
        <div class="bg-white border border-[#F3E6C7] rounded-xl p-6">
            <div class="font-semibold text-xl mb-6">Other Sangh Information</div>
            <div class="grid grid-cols-2 gap-y-6 gap-x-8">
                <div>
                    <div class="text-[#666] text-base">Is there any other jain sangh in your city/village?</div>
                    <div class="font-semibold text-lg mt-1">{{ $event->has_other_sangh ? 'Yes' : 'No' }}</div>
                </div>
                <div>
                    <div class="text-[#666] text-base">No. Of Members</div>
                    <div class="font-semibold text-lg mt-1">{{ $event->member_count ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-[#666] text-base">No. Of Jain Families</div>
                    <div class="font-semibold text-lg mt-1">{{ $event->jain_family_count ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-[#666] text-base">Are they celebrate/willing to celebrate paryushan with us?</div>
                    <div class="font-semibold text-lg mt-1">{{ $event->willing_to_celebrate ? 'Yes' : 'No' }}</div>
                </div>
            </div>
        </div>
        <!-- Accommodation - Contact Person -->
        <div class="bg-white border border-[#F3E6C7] rounded-xl p-6">
            <div class="font-semibold text-xl mb-6">Accommodation - Contact Person</div>
            <div class="grid grid-cols-2 gap-y-6 gap-x-8">
                <div>
                    <div class="text-[#666] text-base">First Name</div>
                    <div class="font-semibold text-lg mt-1">{{ $event->contact_person['first_name'] ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-[#666] text-base">Surname</div>
                    <div class="font-semibold text-lg mt-1">{{ $event->contact_person['surname'] ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-[#666] text-base">Middle Name</div>
                    <div class="font-semibold text-lg mt-1">{{ $event->contact_person['middle_name'] ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-[#666] text-base">Email Address</div>
                    <div class="font-semibold text-lg mt-1">{{ $event->contact_person['email'] ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-[#666] text-base">Phone Number</div>
                    <div class="font-semibold text-lg mt-1">{{ $event->contact_person['phone'] ?? '-' }}</div>
                </div>
            </div>
        </div>
        <!-- Regarding Pravachan -->
        <div class="bg-white border border-[#F3E6C7] rounded-xl p-6">
            <div class="font-semibold text-xl mb-6">Regarding Pravachan</div>
            <div class="grid grid-cols-2 gap-y-6 gap-x-8">
                <div class="col-span-2">
                    <div class="text-[#666] text-base">Is there a sangh member proficient in performing the 5 pratikraman with kriya?</div>
                    <div class="font-semibold text-lg mt-1">{{ $event->pratikraman_proficient ? 'Yes' : 'No' }}</div>
                </div>
                <div>
                    <div class="text-[#666] text-base">How many?</div>
                    <div class="font-semibold text-lg mt-1">{{ $event->pratikraman_how_many ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-[#666] text-base">Will they remain present during the paryushan?</div>
                    <div class="font-semibold text-lg mt-1">{{ $event->pratikraman_present ? 'Yes' : 'No' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Regarding Bhakti/Bhavana -->
    <div class="bg-white border border-[#F3E6C7] rounded-xl p-6 mb-6">
        <div class="font-semibold text-lg mb-4">Regarding Bhakti/Bhavana</div>
        <div class="flex flex-col gap-2">
            <div class="flex flex-wrap gap-x-8 gap-y-2 mt-2">
                <div class="w-full md:w-1/2">
                    <div class="text-sm text-[#888]">Does shree sangh arrange for professional musicians during paryushan?</div>
                    <div class="font-medium text-base text-[#222]">{{ $event->bhakti_musicians ? 'Yes' : 'No' }}</div>
                </div>
                <div class="w-full md:w-1/2 mt-2">
                    <div class="text-sm text-[#888]">Does shree sangh have any bhakti group of youngsters which perform bhakti/bhavana occasionally?</div>
                    <div class="font-medium text-base text-[#222]">{{ $event->bhakti_group ? 'Yes' : 'No' }}</div>
                </div>
                <div class="w-full md:w-1/2 mt-2">
                    <div class="text-sm text-[#888]">Does shree sangh have any musical instruments?</div>
                    <div class="font-medium text-base text-[#222]">{{ $event->bhakti_instruments ? 'Yes' : 'No' }}</div>
                </div>
                <div class="w-full md:w-1/2 mt-2">
                    <div class="text-sm text-[#888]">Select the instrument that shree sangh have</div>
                    <div class="font-medium text-base text-[#222]">
                        @if (!empty($event->bhakti_instrument_list) && is_array($event->bhakti_instrument_list))
                            {{ collect($event->bhakti_instrument_list)->map(fn($k) => \App\Constants\Constants::BHAKTI_INSTRUMENTS[$k] ?? $k)->implode(', ') }}
                        @else
                            -
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Anticipated Attendance Table -->
    <div class="bg-white border border-[#F3E6C7] rounded-xl p-6 mb-6">
        <div class="font-semibold text-lg mb-4">Anticipated attendance for carious activities which are going to be organized by our veer - sainik during paryushan</div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-t border-b border-[#F3E6C7]">
                <thead>
                    <tr class="bg-[#F8F5ED]">
                        <th class="py-2 px-4 font-semibold">Particulars</th>
                        <th class="py-2 px-4 font-semibold">Morning</th>
                        <th class="py-2 px-4 font-semibold">Afternoon</th>
                        <th class="py-2 px-4 font-semibold">Evening</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(['pratikraman', 'pravachan', 'bhakti', 'other'] as $activity)
                        <tr>
                            <td class="py-2 px-4">{{ $activity }}</td>
                            <td class="py-2 px-4">{{ $event->attendance[$activity]['morning'] ?? '-' }}</td>
                            <td class="py-2 px-4">{{ $event->attendance[$activity]['afternoon'] ?? '-' }}</td>
                            <td class="py-2 px-4">{{ $event->attendance[$activity]['evening'] ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Regarding Mahatma -->
    <div class="bg-white border border-[#F3E6C7] rounded-xl p-6 mb-6">
        <div class="font-semibold text-lg mb-4">Regarding Mahatma</div>
        <div class="flex flex-col gap-2">
            <div class="text-sm text-[#888]">Is there any sadhu - bhagavant located within a 5-10 km radius from our shree sangh?</div>
            <div class="font-medium text-base text-[#222] mb-2">{{ $event->mahatma_sadhu ? 'Yes' : 'No' }}</div>
            <div class="text-sm text-[#888]">Is there any sadhviji - bhagavant located within a 5-10 km radius from our shree sangh?</div>
            <div class="font-medium text-base text-[#222] mb-2">{{ $event->mahatma_sadhviji ? 'Yes' : 'No' }}</div>
            <div class="text-sm text-[#888]">Is there any sadhviji-bhagavant present at our shree sangh for chaturmas?</div>
            <div class="font-medium text-base text-[#222]">{{ $event->mahatma_chaturmas ? 'Yes' : 'No' }}</div>
        </div>
    </div>
</div>

{{-- Modal for Center Assignment Status --}}
<div id="centerStatusModal" class="fixed inset-0 z-50 flex items-center justify-center bg-[#F3E6C7]/70 backdrop-blur-sm hidden transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 pt-12 pr-12 relative animate-fadeIn">
        <button id="closeCenterStatusModal" class="absolute top-4 right-4 bg-white rounded-full shadow p-3 text-gray-400 hover:text-gray-600 focus:outline-none z-10">
            <i class="fas fa-times text-xl"></i>
        </button>
        <h3 class="text-lg font-semibold text-[#1A2B49] mb-4">Sub Admin Status</h3>
        <table class="min-w-max w-full table-auto text-sm border mb-2">
            <thead>
                <tr class="bg-[#F3E6C7]">
                    <th class="px-2 py-1">Center</th>
                    <th class="px-2 py-1">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($event->centerAssignments as $assignment)
                    <tr>
                        <td class="px-2 py-1">{{ $assignment->center->center_name ?? '-' }}</td>
                        <td class="px-2 py-1 text-center">
                            @if($assignment->status == 'accepted')
                                <span title="Accepted" class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-blue-100"><i class="fas fa-check text-blue-500"></i></span>
                            @elseif($assignment->status == 'rejected')
                                <span title="Rejected" class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-red-100"><i class="fas fa-times text-red-500"></i></span>
                            @else
                                <span title="Pending" class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-yellow-100"><i class="fas fa-clock text-yellow-500"></i></span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection 

@push('scripts')
<script>
    $(document).ready(function() {
        $('.status-select').on('change', function() {
            const select = $(this);
            const id = select.data('id');
            const status = select.val();

            $.ajax({
                url: '/sangh/paryushan/events/update-status',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message || 'Status updated successfully.',
                            background: '#f8f5ed',
                            confirmButtonColor: '#C9A14A'
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Failed to update status',
                        background: '#f8f5ed',
                        confirmButtonColor: '#C9A14A'
                    });
                }
            });
        });

        // Assignment to center (sub admin)
        $('.assing-to').on('change', function() {
            const select = $(this);
            const eventId = select.data('id');
            const centerId = select.val();
            if (!centerId) return;
            $.ajax({
                url: `/sangh/paryushan/events/${eventId}/assign-center`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    center_id: centerId
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message || 'Event assigned to center successfully.',
                        background: '#f8f5ed',
                        confirmButtonColor: '#C9A14A'
                    }).then(() => {
                        // Always show the assign sub admin dropdown after assignment if event is approved
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Failed to assign event',
                        background: '#f8f5ed',
                        confirmButtonColor: '#C9A14A'
                    });
                }
            });
        });

        // Center status modal logic
        $('#centerStatusBtn').on('click', function() {
            $('#centerStatusModal').removeClass('hidden');
        });
        $('#closeCenterStatusModal').on('click', function() {
            $('#centerStatusModal').addClass('hidden');
        });
        $('#centerStatusModal').on('click', function(e) {
            if (e.target === this) {
                $(this).addClass('hidden');
            }
        });
    });
</script>
@endpush 

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn { animation: fadeIn 0.3s ease; }
    #centerStatusModal { background: rgba(243, 230, 199, 0.7) !important; }
    #centerStatusModal .bg-white { box-shadow: 0 10px 40px 0 rgba(0,0,0,0.15); }
</style>
@endpush 