<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome!</title>
</head>

<body>

    @php
        $role = '';
        if ($user['role'] === 'user') {
            $role = 'User';
        }
        if ($user['role'] === 'seller') {
            $role = 'Seller';
        }
    @endphp
    <p style="margin-top: 20px;">Hello {{ $user['name'] }},</p>
    <p style="margin-top: 10px;">Your Phone number is: {{ $user['mobile'] }}</p>

    <p style="margin-top: 10px;">You have been successfully registered with us as a {{ $role }}!</p>
    <p style="margin-top: 20px;">Please verify your email. <a
            href="{{ URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), ['id' => $user['id'], 'hash' => sha1($user['email'])]) }}">Click
            here to verify</a></p>
</body>

</html>
