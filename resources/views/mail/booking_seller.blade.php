<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>New Booking</title>
</head>

<body>
    <h2>You have a new booking for {{ $homestay->name ?? 'your homestay' }}</h2>

    <p>Hi {{ $seller->name ?? 'Owner' }},</p>

    <p>A new booking has been made. Details below:</p>

    <h3>Booking details</h3>
    <ul>
        <li><strong>Guest name:</strong> {{ $booking->name }}</li>
        <li><strong>Guest phone:</strong> {{ $booking->phone }}</li>
        <li><strong>Guest email:</strong> {{ $booking->email }}</li>
        <li><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($booking->check_in_time)->format('Y-m-d') }}</li>
        <li><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($booking->check_out_time)->format('Y-m-d') }}</li>
        <li><strong>Guest address:</strong> {{ $booking->address ?? '-' }}</li>
    </ul>

    <p>Please contact the guest to confirm arrival details.</p>

    <p>Regards,<br>{{ config('app.name') }}</p>
</body>

</html>
