<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>KNSA|Whatsapp Chat</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <meta
        content=""
        name="description" />
    <meta name="keywords"
        content="KNSA chat, chat, web chat, chat status, communication, discussion, group chat, message, messenger, status" />
    <meta content="KNSA" name="author" />

    @yield('meta')

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon_io/site.webmanifest') }}" rel="icon">
    <link href="{{ asset('assets/img/favicon_io/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('assets/img/favicon_io/favicon-32x32.png') }}" rel="icon" type="image/png" sizes="32x32">
    <link href="{{ asset('assets/img/favicon_io/favicon-16x16.png') }}" rel="icon" type="image/png" sizes="16x16">
    <link href="{{ asset('assets/img/favicon_io/android-chrome-512x512.png') }}" rel="icon" type="image/png"
        sizes="512x512">
    <link href="{{ asset('assets/img/favicon_io/android-chrome-192x192.png') }}" rel="icon" type="image/png"
        sizes="192x192">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon_io/favicon-16x16.png') }}" type="image/x-icon">

    @include('chat.layout.style')
    @yield('styles')
</head>

<body>
    @yield('content')

    @include('chat.layout.script')
    @yield('scripts')
</body>

</html>
