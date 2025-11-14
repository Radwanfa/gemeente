<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex flex-col h-screen overflow-hidden">
        <nav class="flex flex-col border-b-1 sm:flex-row flex-none justify-end">
            <a href="/" class="mr-auto"><img src="{{ asset('images/logo-base.svg') }}" alt="logo"></a>
            @if(session('admin_id'))
                <x-link href="/dashboard" :active="request()->is('dashboard')">Dashboard</x-link>
                <form method="POST" action="/uitloggen" class="inline">
                    @csrf
                    <button type="submit" class="{{ request()->is('uitloggen') ? 'border-b-2 border-green-700' : '' }} py-6 px-3 text-xl hover:text-green-700">
                        Uitloggen
                    </button>
                </form>
            @else
                <x-link href="/melden" :active="request()->is('melden')">melden</x-link>
                <x-link href="/inloggen" :active="request()->is('inloggen')">inloggen</x-link>
            @endif
        </nav>
        {{ $slot }}
    </body>
</html>