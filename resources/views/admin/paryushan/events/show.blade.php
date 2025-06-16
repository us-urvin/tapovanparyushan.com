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
                    <div class="font-medium text-base text-[#222]">{{ $event->bhakti_instrument_list ?? '-' }}</div>
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
                        iziToast.success({
                            title: 'Success',
                            message: response.message,
                            position: 'topRight'
                        });
                        
                        // Update status styles
                        const statusClasses = {
                            0: 'text-yellow-600 bg-yellow-50',
                            1: 'text-blue-500 bg-blue-50',
                            2: 'text-red-500 bg-red-50'
                        };
                        select.removeClass().addClass('status-select ' + statusClasses[status] + ' px-4 py-2 rounded-lg font-semibold');
                    }
                },
                error: function(xhr) {
                    iziToast.error({
                        title: 'Error',
                        message: xhr.responseJSON?.message || 'Failed to update status',
                        position: 'topRight'
                    });
                }
            });
        });
    });
</script>
@endpush 