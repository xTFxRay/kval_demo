<!DOCTYPE html>
<html>
<head>
    <title>Your Verification Code</title>
</head>
<body>
    <h1>Sveiki, {{ Auth::user()->name ?? 'User' }}!</h1>
    <p>Jūsu verifikācijas kods:</p>
    <h2>{{ Session::get('verification_code') }}</h2>
</body>
</html>
