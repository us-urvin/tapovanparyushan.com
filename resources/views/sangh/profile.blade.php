@extends('layouts.admin')

@section('title', 'Sangh Profile')
@section('page-title', 'Sangh Profile')

@section('content')
<div class="bg-[#F8F5ED] min-h-screen p-4">
    <div class="flex justify-between items-center mb-6">
        <div>
            <div class="text-xl font-semibold text-[#1A2B49]">Sangh ID: {{ $sangh->id }}
                <span class="ml-2 bg-[#F3E6C7] text-[#C9A14A] text-xs font-semibold px-3 py-1 rounded">{{ ucfirst($sangh->status) }}</span>
            </div>
        </div>
        <div>
            <a href="{{ route('sangh.profile.edit') }}" class="bg-[#C9A14A] text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#b38e3c] transition">
                + Add Sangh Profile
            </a>
        </div>
    </div>

    <!-- Basic Information -->
    <div class="bg-white rounded-lg shadow p-6 mb-4 border border-[#F3E6C7]">
        <div class="text-lg font-semibold mb-4">Basic Information</div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <div class="text-gray-500 text-sm font-medium mb-1">Name of Shree Sangh</div>
                <div class="text-black text-base font-semibold">{{ $sangh->sangh_name }}</div>
            </div>
            <div>
                <div class="text-gray-500 text-sm font-medium mb-1">Email Address</div>
                <div class="text-black text-base font-semibold">{{ $user->email }}</div>
            </div>
            <div>
                <div class="text-gray-500 text-sm font-medium mb-1">Shree Sangh Type</div>
                <div class="text-black text-base font-semibold">{{ $sangh->sangh_type ?? 'Not specified' }}</div>
            </div>
            <div>
                <div class="text-gray-500 text-sm font-medium mb-1">Phone Number</div>
                <div class="text-black text-base font-semibold">{{ $user->mobile }}</div>
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
                    <div class="text-black text-base font-semibold">{{ $sangh->building_no ?? 'Not specified' }}</div>
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
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th class="py-2 text-left text-gray-500 text-sm font-medium">First Name</th>
                    <th class="py-2 text-left text-gray-500 text-sm font-medium">Surname</th>
                    <th class="py-2 text-left text-gray-500 text-sm font-medium">Phone No.</th>
                    <th class="py-2 text-left text-gray-500 text-sm font-medium">Position Held</th>
                    <th class="py-2 text-left text-gray-500 text-sm font-medium">Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-black text-base font-semibold">{{ explode(' ', $user->name)[0] ?? '' }}</td>
                    <td class="text-black text-base font-semibold">{{ explode(' ', $user->name)[1] ?? '' }}</td>
                    <td class="text-black text-base font-semibold">{{ $user->mobile }}</td>
                    <td class="text-black text-base font-semibold">Trustee</td>
                    <td class="text-black text-base font-semibold">{{ $user->email }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Age-wise Distribution Of Members -->
    <div class="bg-white rounded-lg shadow p-6 mb-4 border border-[#F3E6C7]">
        <div class="text-lg font-semibold mb-4">Age-wise Distribution Of Members</div>
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th class="py-2 text-left text-gray-500 text-sm font-medium">No.</th>
                    <th class="py-2 text-left text-gray-500 text-sm font-medium">Age Group</th>
                    <th class="py-2 text-left text-gray-500 text-sm font-medium">No. Of Members</th>
                </tr>
            </thead>
            <tbody>
                <tr><td class="text-black text-base font-semibold">1</td><td class="text-black text-base font-semibold">0-20 YEARS</td><td class="text-black text-base font-semibold">{{ $sangh->members_0_20 ?? '0' }}</td></tr>
                <tr><td class="text-black text-base font-semibold">2</td><td class="text-black text-base font-semibold">21-40 YEARS</td><td class="text-black text-base font-semibold">{{ $sangh->members_21_40 ?? '0' }}</td></tr>
                <tr><td class="text-black text-base font-semibold">3</td><td class="text-black text-base font-semibold">41-60 YEARS</td><td class="text-black text-base font-semibold">{{ $sangh->members_41_60 ?? '0' }}</td></tr>
                <tr><td class="text-black text-base font-semibold">4</td><td class="text-black text-base font-semibold">60 YEARS +</td><td class="text-black text-base font-semibold">{{ $sangh->members_60_plus ?? '0' }}</td></tr>
                <tr><td class="text-black text-base font-semibold">5</td><td class="text-black text-base font-semibold">Total</td><td class="text-black text-base font-semibold">{{ ($sangh->members_0_20 ?? 0) + ($sangh->members_21_40 ?? 0) + ($sangh->members_41_60 ?? 0) + ($sangh->members_60_plus ?? 0) }}</td></tr>
            </tbody>
        </table>
    </div>

    <!-- Pathshala and Other Sangh Information -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="bg-white rounded-lg shadow p-6 border border-[#F3E6C7]">
            <div class="text-lg font-semibold mb-4">Pathshala Information</div>
            <div class="mb-2 text-gray-500 text-sm font-medium">Does shree sangh have pathshala? <span class="text-black text-base font-semibold">{{ $sangh->has_pathshala ? 'Yes' : 'No' }}</span></div>
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
            <div class="mb-2 text-gray-500 text-sm font-medium">Is there any other jain sangh in your city / village? <span class="text-black text-base font-semibold">{{ $sangh->has_other_sangh ? 'Yes' : 'No' }}</span></div>
            @if($sangh->has_other_sangh)
            <div class="mb-2 text-gray-500 text-sm font-medium">Select any Particulars: <span class="text-black text-base font-semibold">{{ $sangh->other_sangh_type ?? 'Not specified' }}</span></div>
            <div class="mb-2 text-gray-500 text-sm font-medium">No. Of Members: <span class="text-black text-base font-semibold">{{ $sangh->other_sangh_members ?? '0' }}</span></div>
            <div class="text-gray-500 text-sm font-medium">No. Of Jain Families: <span class="text-black text-base font-semibold">{{ $sangh->other_sangh_families ?? '0' }}</span></div>
            @endif
        </div>
    </div>

    <!-- Transportation -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white rounded-lg shadow p-6 border border-[#F3E6C7]">
            <div class="text-lg font-semibold mb-4">Transportation availability from Ahmedabad to Surat</div>
            <div class="font-semibold mb-2 text-gray-500 text-sm">Bus Transportation</div>
            <table class="w-full text-sm mb-4">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 text-left text-gray-500 text-sm font-medium">No.</th>
                        <th class="py-2 text-left text-gray-500 text-sm font-medium">From</th>
                        <th class="py-2 text-left text-gray-500 text-sm font-medium">Station to Disembark the Bus</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sangh->bus_transportation ?? [] as $index => $bus)
                    <tr>
                        <td class="text-black text-base font-semibold">{{ $index + 1 }}</td>
                        <td class="text-black text-base font-semibold">{{ $bus['from'] ?? 'Not specified' }}</td>
                        <td class="text-black text-base font-semibold">{{ $bus['to'] ?? 'Not specified' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-gray-500">No bus transportation details available</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border border-[#F3E6C7]">
            <div class="text-lg font-semibold mb-4">Train Transportation</div>
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 text-left text-gray-500 text-sm font-medium">No.</th>
                        <th class="py-2 text-left text-gray-500 text-sm font-medium">From</th>
                        <th class="py-2 text-left text-gray-500 text-sm font-medium">Train Name</th>
                        <th class="py-2 text-left text-gray-500 text-sm font-medium">Station to Disembark</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sangh->train_transportation ?? [] as $index => $train)
                    <tr>
                        <td class="text-black text-base font-semibold">{{ $index + 1 }}</td>
                        <td class="text-black text-base font-semibold">{{ $train['from'] ?? 'Not specified' }}</td>
                        <td class="text-black text-base font-semibold">{{ $train['name'] ?? 'Not specified' }}</td>
                        <td class="text-black text-base font-semibold">{{ $train['to'] ?? 'Not specified' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500">No train transportation details available</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 