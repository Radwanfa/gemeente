<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Melding Details - {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            #map {
                height: 100%;
                width: 100%;
            }
        </style>
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

        <div class="flex-1 flex overflow-hidden">
            <!-- Aside with complaint details -->
            <aside class="w-full md:w-96 bg-white border-r border-gray-200 overflow-y-auto">
                <div class="p-6">
                    <div class="mb-6">
                        <a href="/dashboard" class="inline-flex items-center gap-2 text-sm text-brand-600 hover:text-brand-700 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Terug naar dashboard
                        </a>
                        <h1 class="text-2xl font-semibold text-brand-700 mb-2">Melding Details</h1>
                        <p class="text-gray-500 text-sm">Melding #{{ $complaint->id }}</p>
                    </div>

                    <div class="space-y-6">
                        <!-- Status -->
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Status</label>
                            <div>
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                                    @if($complaint->status == 'high') bg-red-100 text-red-800
                                    @elseif($complaint->status == 'medium') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800
                                    @endif">
                                    {{ $complaint->status }}
                                </span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Beschrijving</label>
                            <p class="text-gray-900">{{ $complaint->description }}</p>
                        </div>

                        <!-- Reporter Info -->
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Melder</label>
                            <div class="space-y-1">
                                <p class="text-gray-900 font-medium">{{ $complaint->reporter->name ?? 'Onbekend' }}</p>
                                <p class="text-gray-600 text-sm">{{ $complaint->reporter->email ?? 'Onbekend' }}</p>
                            </div>
                        </div>

                        <!-- Location -->
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Locatie</label>
                            <div class="space-y-1">
                                <p class="text-gray-900 text-sm">Latitude: {{ $complaint->latitude }}</p>
                                <p class="text-gray-900 text-sm">Longitude: {{ $complaint->longitude }}</p>
                            </div>
                        </div>

                        <!-- Date -->
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Datum & Tijd</label>
                            <p class="text-gray-900">{{ $complaint->created_at->format('d-m-Y H:i') }}</p>
                        </div>

                        <!-- Photos -->
                        @if($complaint->photo && $complaint->photo->count() > 0)
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-2">Foto's</label>
                                <div class="grid grid-cols-2 gap-2">
                                    @foreach($complaint->photo as $photo)
                                        <img 
                                            src="{{ asset('storage/'.$photo->file_path.$photo->file_name) }}" 
                                            alt="Foto" 
                                            class="w-full h-32 object-cover rounded-lg border border-gray-200 cursor-pointer hover:opacity-80 transition-opacity"
                                            onclick="window.open(this.src, '_blank')"
                                        >
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </aside>

            <!-- Map Container -->
            <div class="flex-1 relative">
                <div id="map" class="absolute inset-0"></div>
            </div>
        </div>

        <!-- Leaflet JavaScript -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            // Initialize map
            const map = L.map('map').setView([{{ $complaint->latitude }}, {{ $complaint->longitude }}], 15);

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(map);

            // Add marker for complaint location
            const marker = L.marker([{{ $complaint->latitude }}, {{ $complaint->longitude }}]).addTo(map);
            const popupContent = '<b>Melding #{{ $complaint->id }}</b><br>';
            marker.bindPopup(popupContent).openPopup();
        </script>
    </body>
</html>

