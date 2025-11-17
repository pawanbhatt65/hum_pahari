<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Booking Confirmation</title>
</head>

<body>
    <h2>Booking Confirmed — {{ $homestay->name ?? 'Homestay' }}</h2>

    <p>Hi {{ $booking->name }},</p>

    <p>Thank you — your booking has been confirmed.</p>

    <h3>Booking details</h3>
    <ul>
        <li><strong>Homestay:</strong> {{ $homestay->name ?? '' }}</li>
        <li><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($booking->check_in_time)->format('d M Y') }}</li>
        <li><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($booking->check_out_time)->format('d M Y') }}</li>
        <li><strong>Address given:</strong> {{ $booking->address ?? '—' }}</li>
    </ul>

    <p>The homestay owner contact number is: <strong>{{ $seller->mobile ?? 'Owner phone not provided' }}</strong></p>
    <p>The homestay owner contact email is: <strong>{{ $seller->email ?? 'Owner phone not provided' }}</strong></p>

    <p>If you have any questions, connect with owner via mobile or email.</p>

    <p>Best regards,<br>{{ config('app.name') }}</p>
</body>

</html>
