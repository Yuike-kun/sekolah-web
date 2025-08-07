<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="backend/assets/images/favicon-32x32.png" type="backend/image/png" />

    {{-- BOOTSTRAP STYLE --}}
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/costume.css') }}">

    {{-- THEME STYLE --}}
    <link href="{{ asset('backend/assets/css/light-theme.css') }}" rel="stylesheet" />
    <title>{{ config('app.name') }} {{ ' | ' }} {{ $title }}</title>

</head>

<body>
    <div class="wrapper">
        <main class="authentication-content">
            {{ $slot }}
        </main>
    </div>
</body>

{{-- PLUGINS --}}
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/pace.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>

@yield('script');

</html>
