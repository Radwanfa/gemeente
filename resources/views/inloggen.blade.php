<x-page-base>
    <div class="w-full h-full bg-brand-50 flex items-center justify-center p-6">
    <main class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <header class="text-center mb-6">
            <h1 class="text-2xl font-semibold text-brand-700">Welkom terug</h1>
            <p class="text-gray-500 text-sm">Log in om verder te gaan</p>
        </header>


        <form class="space-y-5" novalidate>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">E-mailadres</label>
                <input id="email" name="email" type="email" required
                    class="mt-1 w-full rounded-lg border border-gray-200 px-3 py-2 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-300 focus:border-brand-600"
                    placeholder="naam@voorbeeld.nl" />
            </div>


            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Wachtwoord</label>
                <input id="password" name="password" type="password" required
                    class="mt-1 w-full rounded-lg border border-gray-200 px-3 py-2 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-300 focus:border-brand-600"
                    placeholder="••••••••" />
            </div>


            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm text-gray-600">
                    <input type="checkbox"
                        class="h-4 w-4 text-brand-600 focus:ring-brand-500 border-gray-300 rounded" />
                    <span class="ml-2">Onthoud mij</span>
                </label>
                <a href="#" class="text-sm font-medium text-brand-600 hover:text-brand-700">Wachtwoord vergeten?</a>
            </div>


            <button type="submit"
                class="w-full flex items-center justify-center gap-2 rounded-lg bg-brand-600 px-4 py-2 text-white font-semibold shadow hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M2.94 6.94a1.5 1.5 0 012.12 0L8 9.88l6.94-6.94a1.5 1.5 0 012.12 2.12L10.12 12l-.7.7a1 1 0 01-1.4 0L2.94 9.06a1.5 1.5 0 010-2.12z" />
                </svg>
                Inloggen
            </button>


            <p class="text-center text-sm text-gray-600">Nog geen account? <a href="#"
                    class="text-brand-600 font-medium hover:text-brand-700">Registreer hier</a></p>
        </form>
    </main>
    </div>
</x-page-base>