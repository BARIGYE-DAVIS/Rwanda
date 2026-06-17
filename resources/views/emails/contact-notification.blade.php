<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Booking Request</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.6; color:#111;">
    <h2 style="margin:0 0 12px;">New Booking Request Received</h2>

    <p style="margin:0 0 10px;">
        <strong>Booking Reference:</strong>
        #{{ $contact->id ?? 'N/A' }}
    </p>

    <hr style="border:none;border-top:1px solid #e5e7eb;margin:14px 0;">

    <h3 style="margin:0 0 10px;">Personal Information</h3>
    <p style="margin:0 0 6px;"><strong>First Name:</strong> {{ $contact->first_name }}</p>
    <p style="margin:0 0 6px;"><strong>Last Name:</strong> {{ $contact->last_name }}</p>
    <p style="margin:0 0 6px;"><strong>Full Name:</strong> {{ $contact->first_name }} {{ $contact->last_name }}</p>
    <p style="margin:0 0 6px;"><strong>Email:</strong> {{ $contact->email }}</p>
    <p style="margin:0 0 6px;"><strong>WhatsApp Number:</strong> {{ $contact->whatsapp_number ?? 'N/A' }}</p>
    <p style="margin:0 0 6px;"><strong>Nationality:</strong> {{ $contact->nationality ?? 'N/A' }}</p>

    <hr style="border:none;border-top:1px solid #e5e7eb;margin:14px 0;">

    <h3 style="margin:0 0 10px;">Trip Details</h3>
    <p style="margin:0 0 6px;"><strong>Destination:</strong> {{ $contact->destination ?? 'N/A' }}</p>
    <p style="margin:0 0 6px;"><strong>Number of People:</strong> {{ $contact->number_of_people ?? 'N/A' }}</p>
    <p style="margin:0 0 6px;"><strong>Number of Days:</strong> {{ $contact->number_of_days ?? 'N/A' }}</p>
    <p style="margin:0 0 6px;"><strong>Accommodation Type:</strong> {{ $contact->accommodation_list ?? 'N/A' }}</p>
    <p style="margin:0 0 6px;"><strong>Preferred Travel Date:</strong> {{ $contact->preferred_travel_date ?? 'N/A' }}</p>
    <p style="margin:0 0 6px;"><strong>Estimated Budget:</strong> {{ $contact->formatted_budget ?? 'N/A' }}</p>

    <hr style="border:none;border-top:1px solid #e5e7eb;margin:14px 0;">

    <h3 style="margin:0 0 10px;">Additional Comments</h3>
    <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:12px;white-space:pre-wrap;">
        {{ $contact->additional_comments ?? 'No additional comments provided.' }}
    </div>

    <hr style="border:none;border-top:1px solid #e5e7eb;margin:14px 0;">

    <h3 style="margin:0 0 10px;">System Information</h3>
    <p style="margin:0 0 6px;"><strong>Status:</strong> {{ $contact->status_label ?? 'Pending' }}</p>
    <p style="margin:0 0 6px;"><strong>Submitted:</strong> {{ $contact->created_at ? $contact->created_at->format('Y-m-d H:i:s') : 'N/A' }}</p>
    @if(isset($contact->ip_address))
        <p style="margin:0 0 6px;"><strong>IP Address:</strong> {{ $contact->ip_address ?? 'N/A' }}</p>
    @endif

    <p style="margin-top:16px;color:#6b7280;font-size:12px;">
        Sent from {{ config('app.name') }} booking form.
    </p>

    <p style="margin-top:10px;font-size:12px;">
        <a href="{{ url('/admin/bookings/' . $contact->id) }}" style="color:#059669;text-decoration:underline;">
            View this booking in admin panel
        </a>
    </p>
</body>
</html>