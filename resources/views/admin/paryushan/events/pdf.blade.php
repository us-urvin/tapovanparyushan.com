<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Event Details PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; background: #F8F5ED; color: #222; }
        .container { width: 100%; max-width: 800px; margin: 0 auto; background: #fff; border-radius: 12px; padding: 32px 24px; }
        .logo { display: block; margin: 0 auto 24px auto; height: 60px; }
        .event-title { text-align: center; font-size: 22px; font-weight: bold; margin-bottom: 8px; }
        .event-id { text-align: center; color: #C9A14A; font-size: 16px; font-weight: bold; margin-bottom: 24px; }
        .section { margin-bottom: 28px; }
        .section-title { font-size: 16px; font-weight: bold; background: #F3E6C7; padding: 7px 12px; border-radius: 6px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 0; }
        th, td { padding: 7px 8px; }
        .label { color: #666; font-size: 13px; width: 40%; }
        .value { font-weight: bold; font-size: 14px; color: #222; }
        .row { border-bottom: 1px solid #E5E0D8; }
        .row:last-child { border-bottom: none; }
        .attendance-table th, .attendance-table td { border: 1px solid #E5E0D8; text-align: left; }
        .attendance-table th { background: #F3E6C7; }
    </style>
</head>
<body>
<div class="container">
    <!-- Logo -->
    <img src="{{ $logo }}" class="logo" alt="Logo">

    <!-- Event Title and ID -->
    <div class="event-title">Paryushan Event Details</div>
    <div class="event-id">Event ID: {{ $event->id }}</div>

    <!-- Sangh Details -->
    <div class="section">
        <div class="section-title">Sangh Details</div>
        <table>
            <tr class="row">
                <td class="label">Name of Shree Sangh</td>
                <td class="value">{{ $event->sangh->sangh_name ?? '-' }}</td>
            </tr>
            <tr class="row">
                <td class="label">Location</td>
                <td class="value">{{ $event->sangh->city ?? '-' }}</td>
            </tr>
            <tr class="row">
                <td class="label">Event</td>
                <td class="value">Paryushan {{ $event->event_year }} (Vikram samvat {{ $event->event_year ? $event->event_year + 57 : '-' }})</td>
            </tr>
        </table>
    </div>

    <!-- Other Sangh Information -->
    <div class="section">
        <div class="section-title">Other Sangh Information</div>
        <table>
            <tr class="row">
                <td class="label">Is there any other jain sangh in your city/village?</td>
                <td class="value">{{ $event->has_other_sangh ? 'Yes' : 'No' }}</td>
            </tr>
            <tr class="row">
                <td class="label">No. Of Members</td>
                <td class="value">{{ $event->member_count ?? '-' }}</td>
            </tr>
            <tr class="row">
                <td class="label">No. Of Jain Families</td>
                <td class="value">{{ $event->jain_family_count ?? '-' }}</td>
            </tr>
            <tr class="row">
                <td class="label">Are they celebrate/willing to celebrate paryushan with us?</td>
                <td class="value">{{ $event->willing_to_celebrate ? 'Yes' : 'No' }}</td>
            </tr>
        </table>
    </div>

    <!-- Accommodation - Contact Person -->
    <div class="section">
        <div class="section-title">Accommodation - Contact Person</div>
        <table>
            <tr class="row">
                <td class="label">First Name</td>
                <td class="value">{{ $event->contact_person['first_name'] ?? '-' }}</td>
            </tr>
            <tr class="row">
                <td class="label">Surname</td>
                <td class="value">{{ $event->contact_person['surname'] ?? '-' }}</td>
            </tr>
            <tr class="row">
                <td class="label">Middle Name</td>
                <td class="value">{{ $event->contact_person['middle_name'] ?? '-' }}</td>
            </tr>
            <tr class="row">
                <td class="label">Email Address</td>
                <td class="value">{{ $event->contact_person['email'] ?? '-' }}</td>
            </tr>
            <tr class="row">
                <td class="label">Phone Number</td>
                <td class="value">{{ $event->contact_person['phone'] ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <!-- Regarding Pravachan -->
    <div class="section">
        <div class="section-title">Regarding Pravachan</div>
        <table>
            <tr class="row">
                <td class="label">Is there a sangh member proficient in performing the 5 pratikraman with kriya?</td>
                <td class="value">{{ $event->pratikraman_proficient ? 'Yes' : 'No' }}</td>
            </tr>
            <tr class="row">
                <td class="label">How many?</td>
                <td class="value">{{ $event->pratikraman_how_many ?? '-' }}</td>
            </tr>
            <tr class="row">
                <td class="label">Will they remain present during the paryushan?</td>
                <td class="value">{{ $event->pratikraman_present ? 'Yes' : 'No' }}</td>
            </tr>
        </table>
    </div>

    <!-- Regarding Bhakti/Bhavana -->
    <div class="section">
        <div class="section-title">Regarding Bhakti/Bhavana</div>
        <table>
            <tr class="row">
                <td class="label">Does shree sangh arrange for professional musicians during paryushan?</td>
                <td class="value">{{ $event->bhakti_musicians ? 'Yes' : 'No' }}</td>
            </tr>
            <tr class="row">
                <td class="label">Does shree sangh have any bhakti group of youngsters which perform bhakti/bhavana occasionally?</td>
                <td class="value">{{ $event->bhakti_group ? 'Yes' : 'No' }}</td>
            </tr>
            <tr class="row">
                <td class="label">Does shree sangh have any musical instruments?</td>
                <td class="value">{{ $event->bhakti_instruments ? 'Yes' : 'No' }}</td>
            </tr>
            <tr class="row">
                <td class="label">Select the instrument that shree sangh have</td>
                <td class="value">{{ $event->bhakti_instrument_list ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <!-- Anticipated Attendance -->
    <div class="section">
        <div class="section-title">Anticipated Attendance</div>
        <table class="attendance-table">
            <thead>
                <tr>
                    <th>Particulars</th>
                    <th>Morning</th>
                    <th>Afternoon</th>
                    <th>Evening</th>
                </tr>
            </thead>
            <tbody>
                @foreach(['pratikraman', 'pravachan', 'bhakti', 'other'] as $activity)
                    <tr>
                        <td>{{ ucfirst($activity) }}</td>
                        <td>{{ $event->attendance[$activity]['morning'] ?? '-' }}</td>
                        <td>{{ $event->attendance[$activity]['afternoon'] ?? '-' }}</td>
                        <td>{{ $event->attendance[$activity]['evening'] ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Regarding Mahatma -->
    <div class="section">
        <div class="section-title">Regarding Mahatma</div>
        <table>
            <tr class="row">
                <td class="label">Is there any sadhu - bhagavant located within a 5-10 km radius from our shree sangh?</td>
                <td class="value">{{ $event->mahatma_sadhu ? 'Yes' : 'No' }}</td>
            </tr>
            <tr class="row">
                <td class="label">Is there any sadhviji - bhagavant located within a 5-10 km radius from our shree sangh?</td>
                <td class="value">{{ $event->mahatma_sadhviji ? 'Yes' : 'No' }}</td>
            </tr>
            <tr class="row">
                <td class="label">Is there any sadhviji-bhagavant present at our shree sangh for chaturmas?</td>
                <td class="value">{{ $event->mahatma_chaturmas ? 'Yes' : 'No' }}</td>
            </tr>
        </table>
    </div>
</div>
</body>
</html> 