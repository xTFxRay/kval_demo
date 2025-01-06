<!DOCTYPE html>
<html>
<head>
    <title>ModuļuMājas verifikācijas kods</title>
</head>
<body>
    <h1>Sveiki!</h1>
    <p>Jūsu verifikācijas kods:</p>
    <h2>{{ Session::get('verification_code') }}</h2>
</body>
</html>
