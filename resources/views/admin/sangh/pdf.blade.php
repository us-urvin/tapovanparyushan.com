<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sangh Profile PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #222; }
        .logo { text-align: center; margin-bottom: 20px; }
        .logo img { height: 100px; }
        .section-title {
            font-size: 20px;
            font-weight: bold;
            color: #C9A14A;
            margin-top: 32px;
            margin-bottom: 12px;
            border-left: 6px solid #C9A14A;
            padding-left: 12px;
            background: #f8f5ed;
            border-radius: 4px;
        }
        .info-table, .info-table th, .info-table td { border: 1px solid #ccc; border-collapse: collapse; }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
            page-break-inside: avoid;
            table-layout: fixed;
        }
        .info-table th, .info-table td {
            padding: 8px 6px;
            border: 1px solid #E5E0D8;
            font-size: 13px;
            word-break: break-all;
        }
        .info-table th {
            background: #F3E6C7;
            color: #1A2B49;
            font-weight: 700;
            text-transform: uppercase;
        }
        .info-table tr:nth-child(even) { background: #F8F5ED; }
        .info-table tr:nth-child(odd) { background: #fff; }
        .info-table td.email-cell {
            word-break: break-all;
            overflow-wrap: break-word;
            white-space: pre-line;
            max-width: 120px;
        }
        .label { font-weight: bold; width: 200px; }
        .value { }
        .mb-2 { margin-bottom: 10px; }
        .mb-4 { margin-bottom: 20px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .status-badge { padding: 3px 10px; border-radius: 8px; font-size: 12px; }
        .status-accepted { background: #E6F3E6; color: #4CAF50; }
        .status-pending { background: #F3E6C7; color: #C9A14A; }
        .status-rejected { background: #F3E6C7; color: #C00; }
    </style>
</head>
<body>
    <div class="logo">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo">
    </div>
    <h2 class="text-center">Sangh Profile</h2>
    <div class="section-title">Basic Information</div>
    <table class="info-table">
        <tr><th class="label">Sangh ID</th><td class="value">{{ $user->id }}</td></tr>
        <tr><th class="label">Name of Shree Sangh</th><td class="value">{{ $sangh->sangh_name ?? '-' }}</td></tr>
        <tr><th class="label">Email Address</th><td class="value">{{ $sangh->sangh_email ?? '-' }}</td></tr>
        <tr><th class="label">Shree Sangh Type</th><td class="value">{{ App\Constants\Constants::SANGH_TYPE[$sangh->sangh_type] ?? 'Not specified' }}</td></tr>
        <tr><th class="label">Phone Number</th><td class="value">{{ $sangh->sangh_mobile ?? '-' }}</td></tr>
    </table>

    <div class="section-title">Current Address</div>
    <table class="info-table">
        <tr><th class="label">Building / Flat / Plot No.</th><td class="value">{{ $sangh->building_no ?? $sangh->sangh_address }}</td></tr>
        <tr><th class="label">Locality Area</th><td class="value">{{ $sangh->locality ?? '-' }}</td></tr>
        <tr><th class="label">Building Name</th><td class="value">{{ $sangh->building_name ?? '-' }}</td></tr>
        <tr><th class="label">Nearby Landmark</th><td class="value">{{ $sangh->landmark ?? '-' }}</td></tr>
        <tr><th class="label">Pincode</th><td class="value">{{ $user->pincode }}</td></tr>
        <tr><th class="label">State</th><td class="value">{{ $sangh->state ?? '-' }}</td></tr>
        <tr><th class="label">District</th><td class="value">{{ $sangh->district ?? '-' }}</td></tr>
        <tr><th class="label">Country</th><td class="value">{{ $sangh->country ?? 'India' }}</td></tr>
    </table>

    <div class="section-title">Trustee's Details</div>
    <table class="info-table">
        <colgroup>
            <col style="width: 5%;">
            <col style="width: 15%;">
            <col style="width: 15%;">
            <col style="width: 15%;">
            <col style="width: 20%;">
            <col style="width: 30%;">
        </colgroup>
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Surname</th>
                <th>Phone No.</th>
                <th>Position Held</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sangh->trustees as $index => $trustee)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $trustee->first_name ?? '-' }}</td>
                <td>{{ $trustee->last_name ?? '-' }}</td>
                <td>{{ $trustee->phone ?? '-' }}</td>
                <td>{{ $trustee->designation ?? '-' }}</td>
                <td class="email-cell">{{ $trustee->email ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No trustee details available</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">Age-wise Distribution Of Members</div>
    <table class="info-table">
        <tr>
            <th>0-20 YEARS</th>
            <th>21-40 YEARS</th>
            <th>41-60 YEARS</th>
            <th>60 YEARS +</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>{{ $sangh->age_group['0_20'] ?? '0' }}</td>
            <td>{{ $sangh->age_group['21_40'] ?? '0' }}</td>
            <td>{{ $sangh->age_group['41_60'] ?? '0' }}</td>
            <td>{{ $sangh->age_group['60_plus'] ?? '0' }}</td>
            <td>{{ $sangh->age_group['total'] ?? '0' }}</td>
        </tr>
    </table>

    <div class="section-title">Pathshala Information</div>
    <table class="info-table">
        <tr>
            <th>Has Pathshala?</th>
            <td>{{ $sangh->has_pathshala ? 'Yes' : 'No' }}</td>
        </tr>
        @if($sangh->has_pathshala)
        <tr><th>First Name</th><td>{{ $sangh->pathshala_first_name ?? '-' }}</td></tr>
        <tr><th>Last Name</th><td>{{ $sangh->pathshala_last_name ?? '-' }}</td></tr>
        <tr><th>Email Address</th><td>{{ $sangh->pathshala_email ?? '-' }}</td></tr>
        <tr><th>Phone Number</th><td>{{ $sangh->pathshala_phone ?? '-' }}</td></tr>
        @endif
    </table>

    <div class="section-title">Other Sangh Information</div>
    <table class="info-table">
        <tr>
            <th>Has Other Sangh?</th>
            <td>{{ $sangh->has_other_sangh ? 'Yes' : 'No' }}</td>
        </tr>
    </table>
    @if($sangh->has_other_sangh)
    <table class="info-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Particulars</th>
                <th>No. Of Members</th>
                <th>No. Of Jain Families</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sangh->otherSanghs as $index => $otherSangh)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ App\Constants\Constants::PARTICULARS[$otherSangh->particulars] ?? '-' }}</td>
                <td>{{ $otherSangh->no_of_members ?? '-' }}</td>
                <td>{{ $otherSangh->no_of_jain_families ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="section-title">Transportation</div>
    <table class="info-table">
        <tr>
            <th>Bus Transportation</th>
            <td>{{ $sangh->bus_transportation ? 'Yes' : 'No' }}</td>
        </tr>
    </table>
    @if($sangh->bus_transportation)
    <table class="info-table">
        <thead>
            <tr>
                <th>#</th>
                <th>From</th>
                <th>To</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sangh->busTransportations as $index => $bus)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $bus->from ?? '-' }}</td>
                <td>{{ $bus->to ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <table class="info-table">
        <tr>
            <th>Train Transportation</th>
            <td>{{ $sangh->train_transportation ? 'Yes' : 'No' }}</td>
        </tr>
    </table>
    @if($sangh->train_transportation)
    <table class="info-table">
        <thead>
            <tr>
                <th>#</th>
                <th>From</th>
                <th>Train Name</th>
                <th>To</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sangh->trainTransportations as $index => $train)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $train->from ?? '-' }}</td>
                <td>{{ $train->train_name ?? '-' }}</td>
                <td>{{ $train->to ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</body>
</html> 