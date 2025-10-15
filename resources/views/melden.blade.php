<x-page-base>
    <div class="flex justify-center items-center grow text-2xl">
        <img src="{{ asset('images/102657.png') }}"
            class="-z-1 hidden absolute w-9/12 h-2/5 object-cover mb-70 sm:flex">
        <form class="flex bg-green-600 sm:h-10/12 sm:w-2/5 sm:mt-20 sm:mr-50 text-white flex-col p-10 overflow-scroll"
            method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <h1 class="text-center">Meld</h1>
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-medium ">Naam</label>
                    <textarea id="name" name="message" rows="1" required
                        class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-300 focus:border-brand-600"
                        placeholder="Schrijf je bericht hier..."></textarea>
                </div>
                <div class="md:col-span-2">
                    <label for="email" class="block text-sm font-medium ">Email</label>
                    <textarea id="email" name="message" rows="1" required
                        class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-300 focus:border-brand-600"
                        placeholder="Schrijf je bericht hier..."></textarea>
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium ">Bericht</label>
                    <textarea id="description" name="message" rows="6" required
                        class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-300 focus:border-brand-600"
                        placeholder="Schrijf je bericht hier..."></textarea>
                </div>

                    <div class="">
                        <label class="wwwwwwwwwwwwwwwwwwwww text-sm font-medium ">Bijlage (optioneel)</label>
                        <input type="file" name="attachment" accept="image/*" id="input"
                            class="mt-1 block w-full text-sm  file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-brand-100 file:text-brand-700 hover:file:bg-brand-200 hover:border-2" />
                    </div>
                
                


                <fieldset id="checkbox" class="md:col-span-2 mt-2">
                    <legend class="text-sm font-medium ">Prioriteit</legend>
                    <div class="mt-2 flex gap-4">
                        <label class="inline-flex items-center gap-2 text-sm">
                            <input type="radio" name="priority" value="low" checked
                                class="text-brand-600 focus:ring-brand-500" />
                            <span>Laag</span>
                        </label>
                        <label class="inline-flex items-center gap-2 text-sm">
                            <input type="radio" name="priority" value="normal"
                                class="text-brand-600 focus:ring-brand-500" />
                            <span>Normaal</span>
                        </label>
                        <label class="inline-flex items-center gap-2 text-sm">
                            <input type="radio" name="priority" value="high"
                                class="text-brand-600 focus:ring-brand-500" />
                            <span>Spoed</span>
                        </label>
                    </div>
                </fieldset>
            </div>


            <p id="form-message" class="mt-4 text-sm text-red-600 hidden" role="status"></p>


            <div class="mt-6 flex items-center justify-between gap-4">
                <button type="submit" onclick="store(event)"
                    class="inline-flex items-center gap-2 rounded-lg bg-brand-600 px-4 py-2 text-white font-semibold shadow hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path
                            d="M2.94 6.94a1.5 1.5 0 012.12 0L8 9.88l6.94-6.94a1.5 1.5 0 012.12 2.12L10.12 12l-.7.7a1 1 0 01-1.4 0L2.94 9.06a1.5 1.5 0 010-2.12z" />
                    </svg>
                    Verzenden
                </button>


                <button type="reset"
                    class="rounded-lg border text-green-700 border-gray-200 bg-white px-4 py-2 text-sm font-medium hover:bg-gray-50">Reset</button>


                <div class="ml-auto text-sm">Velden met <span class="text-red-600">*</span> zijn verplicht
                </div>
            </div>
        </form>
    </div>
</x-page-base>