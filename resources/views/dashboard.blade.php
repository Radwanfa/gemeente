<x-page-base>
    <div class="w-full min-h-screen bg-brand-50 p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-semibold text-brand-700 mb-2">Admin Dashboard</h1>
                <p class="text-gray-600">Beheer en bekijk meldingen</p>
            </div>

            <!-- Search Section -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                <h2 class="text-xl font-semibold text-brand-700 mb-4">Zoek melding op ID</h2>
                <form method="GET" action="/dashboard" class="flex gap-4">
                    <input 
                        type="number" 
                        name="search_id" 
                        value="{{ $searchId ?? '' }}"
                        placeholder="Voer melding ID in" 
                        class="flex-1 rounded-lg border border-gray-200 px-4 py-2 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-300 focus:border-brand-600"
                    />
                    <button 
                        type="submit"
                        class="px-6 py-2 rounded-lg bg-brand-600 text-black font-semibold shadow hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-300"
                    >
                        Zoeken
                    </button>
                </form>

                <!-- Search Results -->
                @if(isset($searchResult))
                    @if($searchResult)
                        <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <h3 class="text-lg font-semibold text-green-800 mb-3">Melding gevonden (ID: {{ $searchResult->id }})</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Beschrijving:</p>
                                    <p class="text-gray-900 font-medium">{{ $searchResult->description }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Status:</p>
                                    <p class="text-gray-900 font-medium">{{ $searchResult->status }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Melder:</p>
                                    <p class="text-gray-900 font-medium">{{ $searchResult->reporter->name ?? 'Onbekend' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">E-mail:</p>
                                    <p class="text-gray-900 font-medium">{{ $searchResult->reporter->email ?? 'Onbekend' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Locatie:</p>
                                    <p class="text-gray-900 font-medium">{{ $searchResult->latitude }}, {{ $searchResult->longitude }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Datum:</p>
                                    <p class="text-gray-900 font-medium">{{ $searchResult->created_at->format('d-m-Y H:i') }}</p>
                                </div>
                            </div>
                            @if($searchResult->photo && $searchResult->photo->count() > 0)
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 mb-2">Foto's:</p>
                                    <div class="flex gap-2 flex-wrap">
                                        @foreach($searchResult->photo as $photo)
                                            <img src="{{ $photo->url }}" alt="Foto" class="w-24 h-24 object-cover rounded-lg border border-gray-200">
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="mt-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-red-800">Geen melding gevonden met ID: {{ $searchId }}</p>
                        </div>
                    @endif
                @endif
            </div>

            <!-- Recent Complaints Section -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-xl font-semibold text-brand-700 mb-4">Laatste 5 meldingen</h2>
                
                @if($recentComplaints->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">ID</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Beschrijving</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Melder</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Status</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Datum</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentComplaints as $complaint)
                                    <tr 
                                        class="border-b border-gray-100 hover:bg-gray-50 cursor-pointer transition-colors"
                                        onclick="window.location.href='/dashboard/complaint/{{ $complaint->id }}'"
                                    >
                                        <td class="py-3 px-4 text-sm text-gray-900">{{ $complaint->id }}</td>
                                        <td class="py-3 px-4 text-sm text-gray-900">{{ Str::limit($complaint->description, 50) }}</td>
                                        <td class="py-3 px-4 text-sm text-gray-900">{{ $complaint->reporter->name ?? 'Onbekend' }}</td>
                                        <td class="py-3 px-4">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                                @if($complaint->status == 'high') bg-red-100 text-red-800
                                                @elseif($complaint->status == 'medium') bg-yellow-100 text-yellow-800
                                                @else bg-green-100 text-green-800
                                                @endif">
                                                {{ $complaint->status }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-sm text-gray-900">{{ $complaint->created_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-500">Geen meldingen gevonden.</p>
                    </div>
                @endif
            </div>

            <!-- Logout Button -->
            <div class="mt-6 flex justify-end">
                <form method="POST" action="/uitloggen">
                    @csrf
                    <button 
                        type="submit"
                        class="px-6 py-2 rounded-lg bg-red-600 text-white font-semibold shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300"
                    >
                        Uitloggen
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-page-base>

