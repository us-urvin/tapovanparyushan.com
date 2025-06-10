@extends('layouts.admin')

@section('title', 'View Sangh Profile')
@section('page-title', 'View Sangh Profile')

@section('content')
<div class="bg-[#F8F5ED] min-h-screen p-4">
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-4">
            <div class="text-xl font-semibold text-[#1A2B49]">Sangh ID: {{ $user->id }}
                <span class="ml-2 {{ $user->status == 'accepted' ? 'bg-[#E6F3E6] text-[#4CAF50]' : 'bg-[#F3E6C7] text-[#C9A14A]' }} text-xs font-semibold px-3 py-1 rounded" id="userStatusLabel">{{ ucfirst($user->status) }}</span>
            </div>
            <div class="flex flex-col md:flex-row items-start md:items-center gap-2 md:gap-4">
                <select id="sanghStatus" class="statusDropdown rounded-lg border border-[#C9A14A] px-4 py-2 text-[#1A2B49] font-semibold focus:ring-2 focus:ring-[#C9A14A] focus:outline-none transition" data-user-id="{{ $user->id }}">
                    <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="accepted" {{ $user->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="rejected" {{ $user->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <a href="{{ route('admin.sangh.downloadPdf', $user->id) }}" class="bg-[#C9A14A] text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition ml-4" target="_blank">
                <i class="fa fa-download"></i> Download PDF
            </a>
        </div>
        <div>
            <a href="{{ route('admin.sangh.index') }}" class="bg-[#C9A14A] text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <!-- Basic Information -->
    <div class="bg-white rounded-lg shadow p-6 mb-4 border border-[#F3E6C7]">
        <div class="text-lg font-semibold mb-4">Basic Information</div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <div class="text-gray-500 text-sm font-medium mb-1">Name of Shree Sangh</div>
                <div class="text-black text-base font-semibold">{{ $sangh->sangh_name ?? '-' }}</div>
            </div>
            <div>
                <div class="text-gray-500 text-sm font-medium mb-1">Email Address</div>
                <div class="text-black text-base font-semibold">{{ $sangh->sangh_email ?? '-' }}</div>
            </div>
            <div>
                <div class="text-gray-500 text-sm font-medium mb-1">Shree Sangh Type</div>
                <div class="text-black text-base font-semibold">{{ App\Constants\Constants::SANGH_TYPE[$sangh->sangh_type] ?? 'Not specified' }}</div>
            </div>
            <div>
                <div class="text-gray-500 text-sm font-medium mb-1">Phone Number</div>
                <div class="text-black text-base font-semibold">{{ $sangh->sangh_mobile ?? '-' }}</div>
            </div>
        </div>
    </div>

    <!-- Current Address -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="bg-white rounded-lg shadow p-6 border border-[#F3E6C7]">
            <div class="text-lg font-semibold mb-4">Current Address</div>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <div class="text-gray-500 text-sm font-medium mb-1">Building / Flat / Apartment / Plot No.</div>
                    <div class="text-black text-base font-semibold">{{ $sangh->building_no ?? $sangh->sangh_address }}</div>
                </div>
                <div>
                    <div class="text-gray-500 text-sm font-medium mb-1">Locality Area</div>
                    <div class="text-black text-base font-semibold">{{ $sangh->locality ?? 'Not specified' }}</div>
                </div>
                <div>
                    <div class="text-gray-500 text-sm font-medium mb-1">Building / Flat / Apartment Name</div>
                    <div class="text-black text-base font-semibold">{{ $sangh->building_name ?? 'Not specified' }}</div>
                </div>
                <div>
                    <div class="text-gray-500 text-sm font-medium mb-1">Nearby Landmark</div>
                    <div class="text-black text-base font-semibold">{{ $sangh->landmark ?? 'Not specified' }}</div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border border-[#F3E6C7]">
            <div class="text-lg font-semibold mb-4">&nbsp;</div>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <div class="text-gray-500 text-sm font-medium mb-1">Pincode</div>
                    <div class="text-black text-base font-semibold">{{ $user->pincode }}</div>
                </div>
                <div>
                    <div class="text-gray-500 text-sm font-medium mb-1">State</div>
                    <div class="text-black text-base font-semibold">{{ $sangh->state ?? 'Not specified' }}</div>
                </div>
                <div>
                    <div class="text-gray-500 text-sm font-medium mb-1">District</div>
                    <div class="text-black text-base font-semibold">{{ $sangh->district ?? 'Not specified' }}</div>
                </div>
                <div>
                    <div class="text-gray-500 text-sm font-medium mb-1">Country</div>
                    <div class="text-black text-base font-semibold">{{ $sangh->country ?? 'India' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trustees Details -->
    <div class="bg-white rounded-lg shadow p-6 mb-4 border border-[#F3E6C7]">
        <div class="text-lg font-semibold mb-4">Trustee's Details</div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#F3E6C7]">
                <thead class="bg-[#F8F5ED]">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">First Name</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Surname</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Phone No.</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Position Held</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#F3E6C7]">
                    @forelse($sangh->trustees as $index => $trustee)
                    <tr class="hover:bg-[#F8F5ED] transition">
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-base font-semibold text-[#1A2B49]">{{ $trustee->first_name ?? '-' }}</td>
                        <td class="px-4 py-3 text-base font-semibold text-[#1A2B49]">{{ $trustee->last_name ?? '-' }}</td>
                        <td class="px-4 py-3 text-base font-semibold text-gray-700">{{ $trustee->phone ?? '-' }}</td>
                        <td class="px-4 py-3 text-base font-semibold text-gray-700">{{ $trustee->designation ?? '-' }}</td>
                        <td class="px-4 py-3 text-base font-semibold text-gray-700 break-all">{{ $trustee->email ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500">No trustee details available</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Age-wise Distribution Of Members -->
    <div class="bg-white rounded-lg shadow p-6 mb-4 border border-[#F3E6C7]">
        <div class="text-lg font-semibold mb-4">Age-wise Distribution Of Members</div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
            <div class="bg-[#F8F5ED] rounded-lg p-4 flex flex-col items-center justify-center border border-[#F3E6C7]">
                <div class="text-xs text-gray-500 font-medium mb-1">Members</div>
                <div class="text-2xl font-bold text-[#C9A14A]">
                    <i class="fas fa-users" style="color: #C9A14A; font-size: 1.75rem;"></i>
                </div>
            </div>
            <div class="bg-[#F8F5ED] rounded-lg p-4 flex flex-col items-center border border-[#F3E6C7]">
                <div class="text-xs text-gray-500 font-medium mb-1">0-20 YEARS</div>
                <div class="text-2xl font-bold text-[#1A2B49]">{{ isset($sangh->age_group['0_20']) ? $sangh->age_group['0_20'] : '0' }}</div>
            </div>
            <div class="bg-[#F8F5ED] rounded-lg p-4 flex flex-col items-center border border-[#F3E6C7]">
                <div class="text-xs text-gray-500 font-medium mb-1">21-40 YEARS</div>
                <div class="text-2xl font-bold text-[#1A2B49]">{{ isset($sangh->age_group['21_40']) ? $sangh->age_group['21_40'] : '0' }}</div>
            </div>
            <div class="bg-[#F8F5ED] rounded-lg p-4 flex flex-col items-center border border-[#F3E6C7]">
                <div class="text-xs text-gray-500 font-medium mb-1">41-60 YEARS</div>
                <div class="text-2xl font-bold text-[#1A2B49]">{{ isset($sangh->age_group['41_60']) ? $sangh->age_group['41_60'] : '0' }}</div>
            </div>
            <div class="bg-[#F8F5ED] rounded-lg p-4 flex flex-col items-center border border-[#F3E6C7]">
                <div class="text-xs text-gray-500 font-medium mb-1">60 YEARS +</div>
                <div class="text-2xl font-bold text-[#1A2B49]">{{ isset($sangh->age_group['60_plus']) ? $sangh->age_group['60_plus'] : '0' }}</div>
            </div>
            <div class="bg-[#F8F5ED] rounded-lg p-4 flex flex-col items-center border border-[#F3E6C7]">
                <div class="text-xs text-gray-500 font-medium mb-1">Total</div>
                <div class="text-2xl font-bold text-[#1A2B49]">
                    {{ isset($sangh->age_group['total']) ? $sangh->age_group['total'] : '0' }}
                </div>
            </div>
        </div>
    </div>

    <!-- Pathshala and Other Sangh Information -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="bg-white rounded-lg shadow p-6 border border-[#F3E6C7]">
            <div class="text-lg font-semibold mb-4">Pathshala Information</div>
            <div class="mb-2 text-gray-500 text-sm font-medium mb-4">Does shree sangh have pathshala? <span class="text-black text-base font-semibold">{{ $sangh->has_pathshala ? 'Yes' : 'No' }}</span></div>
            @if($sangh->has_pathshala)
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <div class="text-gray-500 text-sm font-medium mb-1">First Name</div>
                    <div class="text-black text-base font-semibold">{{ $sangh->pathshala_first_name ?? 'Not specified' }}</div>
                </div>
                <div>
                    <div class="text-gray-500 text-sm font-medium mb-1">Email Address</div>
                    <div class="text-black text-base font-semibold">{{ $sangh->pathshala_email ?? 'Not specified' }}</div>
                </div>
                <div>
                    <div class="text-gray-500 text-sm font-medium mb-1">Last Name</div>
                    <div class="text-black text-base font-semibold">{{ $sangh->pathshala_last_name ?? 'Not specified' }}</div>
                </div>
                <div>
                    <div class="text-gray-500 text-sm font-medium mb-1">Phone Number</div>
                    <div class="text-black text-base font-semibold">{{ $sangh->pathshala_phone ?? 'Not specified' }}</div>
                </div>
            </div>
            @endif
        </div>
        <div class="bg-white rounded-lg shadow p-6 border border-[#F3E6C7]">
            <div class="text-lg font-semibold mb-4">Other Sangh Information</div>
            <div class="mb-2 text-gray-500 text-sm font-medium mb-4">Is there any other jain sangh in your city / village? <span class="text-black text-base font-semibold">{{ $sangh->has_other_sangh ? 'Yes' : 'No' }}</span></div>
            @if($sangh->has_other_sangh)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[#F3E6C7]">
                    <thead class="bg-[#F8F5ED]">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Particulars</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No. Of Members</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No. Of Jain Families</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-[#F3E6C7]">
                        @foreach($sangh->otherSanghs as $index => $otherSangh)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-base font-semibold text-[#1A2B49]">{{ App\Constants\Constants::PARTICULARS[$otherSangh->particulars] ?? '-' }}</td>
                            <td class="px-4 py-3 text-base font-semibold text-gray-700">{{ $otherSangh->no_of_members ?? '-' }}</td>
                            <td class="px-4 py-3 text-base font-semibold text-gray-700">{{ $otherSangh->no_of_jain_families ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    <!-- Transportation -->
    <div class="bg-white rounded-lg shadow p-6 mb-4 border border-[#F3E6C7]">
        <div class="text-lg font-semibold mb-4">Transportation availability from Ahmedabad to Surat</div>
        <div class="mb-4">
            <span class="text-gray-500 text-sm font-medium">Bus Transportation: </span>
            <span class="text-black text-base font-semibold">{{ $sangh->bus_transportation ? 'Yes' : 'No' }}</span>
        </div>
        @if($sangh->bus_transportation)
        <div class="overflow-x-auto mb-4">
            <table class="min-w-full divide-y divide-[#F3E6C7]">
                <thead class="bg-[#F8F5ED]">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">From</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">To</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#F3E6C7]">
                    @foreach($sangh->busTransportations as $index => $bus)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-base font-semibold text-[#1A2B49]">{{ $bus->from ?? '-' }}</td>
                        <td class="px-4 py-3 text-base font-semibold text-[#1A2B49]">{{ $bus->to ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        <div class="mb-4">
            <span class="text-gray-500 text-sm font-medium">Train Transportation: </span>
            <span class="text-black text-base font-semibold">{{ $sangh->train_transportation ? 'Yes' : 'No' }}</span>
        </div>
        @if($sangh->train_transportation)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#F3E6C7]">
                <thead class="bg-[#F8F5ED]">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">From</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Train Name</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">To</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#F3E6C7]">
                    @foreach($sangh->trainTransportations as $index => $train)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-base font-semibold text-[#1A2B49]">{{ $train->from ?? '-' }}</td>
                        <td class="px-4 py-3 text-base font-semibold text-[#1A2B49]">{{ $train->train_name ?? '-' }}</td>
                        <td class="px-4 py-3 text-base font-semibold text-[#1A2B49]">{{ $train->to ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection 

@push('scripts')
<script>
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
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            },
            error: function() {
                iziToast.error({ title: 'Error', message: 'Failed to update status.' });
            }
        });
    });
</script>    
@endpush('scripts')

@push('styles')
<style>
.statusDropdown {
    min-width: 150px;
    background: #F8F5ED;
    border: 1.5px solid #C9A14A;
    border-radius: 8px;
    padding: 8px 16px;
    font-size: 1rem;
    color: #1A2B49;
    font-weight: 600;
    transition: border 0.2s, box-shadow 0.2s;
}
.statusDropdown:focus {
    border-color: #C9A14A;
    box-shadow: 0 0 0 2px #F3E6C7;
    outline: none;
}
</style>
@endpush
