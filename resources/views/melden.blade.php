<x-page-base>
    <div class="w-full min-h-screen bg-brand-50 flex items-center justify-center p-6">
        <main class="w-full max-w-2xl bg-white rounded-2xl shadow-lg p-8">
            <header class="text-center mb-6">
                <h1 class="text-2xl font-semibold text-brand-700 mb-2">Melding indienen</h1>
                <p class="text-gray-500 text-sm">Vul het onderstaande formulier in om een melding te doen</p>
            </header>

            <p id="form-message" class="mb-4 text-sm text-red-600 hidden" role="status"></p>

            <form method="POST" onsubmit="store(event)" class="space-y-6">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Naam <span class="text-red-600">*</span>
                    </label>
                    <input 
                        id="name" 
                        name="name" 
                        type="text" 
                        required
                        class="w-full rounded-lg border border-gray-200 px-4 py-2 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-300 focus:border-brand-600"
                        placeholder="Uw naam"
                    />
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        E-mailadres <span class="text-red-600">*</span>
                    </label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        required
                        class="w-full rounded-lg border border-gray-200 px-4 py-2 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-300 focus:border-brand-600"
                        placeholder="uw.email@voorbeeld.nl"
                    />
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Beschrijving <span class="text-red-600">*</span>
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="6" 
                        required
                        class="w-full rounded-lg border border-gray-200 px-4 py-2 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-300 focus:border-brand-600 resize-none"
                        placeholder="Beschrijf uw melding hier..."
                    ></textarea>
                </div>

                <div>
                    <label for="input" class="block text-sm font-medium text-gray-700 mb-1">
                        Foto bijlage (optioneel)
                    </label>
                    <input 
                        type="file" 
                        name="photo" 
                        accept="image/*" 
                        id="input"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-brand-100 file:text-brand-700 hover:file:bg-brand-200 cursor-pointer" 
                    />
                    <p class="mt-1 text-xs text-gray-500">Upload een foto om uw melding te illustreren</p>
                </div>

                <fieldset id="checkbox" class="border border-gray-200 rounded-lg p-4">
                    <legend class="text-sm font-medium text-gray-700 px-2">
                        Prioriteit <span class="text-red-600">*</span>
                    </legend>
                    <div class="mt-3 flex flex-wrap gap-6">
                        <label class="inline-flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                            <input 
                                type="radio" 
                                name="priority" 
                                value="low" 
                                checked
                                class="w-4 h-4 text-brand-600 focus:ring-brand-500 border-gray-300"
                            />
                            <span>Laag</span>
                        </label>
                        <label class="inline-flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                            <input 
                                type="radio" 
                                name="priority" 
                                value="normal"
                                class="w-4 h-4 text-brand-600 focus:ring-brand-500 border-gray-300"
                            />
                            <span>Normaal</span>
                        </label>
                        <label class="inline-flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                            <input 
                                type="radio" 
                                name="priority" 
                                value="high"
                                class="w-4 h-4 text-brand-600 focus:ring-brand-500 border-gray-300"
                            />
                            <span>Spoed</span>
                        </label>
                    </div>
                </fieldset>

                
                <div class="pt-4 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <p class="text-xs text-gray-500">
                            Velden met <span class="text-red-600">*</span> zijn verplicht
                        </p>
                        <div class="flex gap-3 w-full sm:w-auto">
                            <button 
                                type="reset"
                                class="flex-1 sm:flex-none px-6 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 text-sm font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300"
                            >
                                Wissen
                            </button>
                            <button 
                                type="submit"
                                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 rounded-lg bg-brand-600 px-6 py-2 text-black font-semibold shadow hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-300"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M2.94 6.94a1.5 1.5 0 012.12 0L8 9.88l6.94-6.94a1.5 1.5 0 012.12 2.12L10.12 12l-.7.7a1 1 0 01-1.4 0L2.94 9.06a1.5 1.5 0 010-2.12z" />
                                </svg>
                                Verzenden
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>
</x-page-base>
