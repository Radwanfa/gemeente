<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
            <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body class="flex flex-col h-screen">
        <nav class="flex flex-col border-b-1 sm:flex-row flex-none justify-end">
            <a href="/" class="mr-auto"><img src="{{ asset('images/logo-base.svg') }}" alt="logo"></a>
            <x-link href="/melden" :active="request()->is('melden')">melden</x-link>
            <x-link href="/inloggen" :active="request()->is('inloggen')">inloggen</x-link>
        </nav>
        {{ $slot }}
    </body>
</html>