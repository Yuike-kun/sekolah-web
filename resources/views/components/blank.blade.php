 <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Passions+Conflict&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/progresscircle.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/fonts/flaticon/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">

        <title>{{ config('app.name') }} {{ ' | ' }} {{ $title }}</title>

    </head>
    <body>
        {{ $slot }}
    </body>
    </html>
