<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu</title>
</head>
<body>
    <p class="">
        Silakan pilih aplikasi:
        <br>
        <a href="{{ base_url('app/sim-spa/dashboard') }}" class="">
            SPA
        </a>
        <br>
        <a href="{{ base_url('app/sim-ig/dashboard') }}">
            IG
        </a>
    </p>
</body>
</html>