<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-20 text-center">
        <p class="text-7xl font-bold text-red-500 mb-4">403</p>
        <h1 class="text-2xl font-bold mb-2">Accès refusé</h1>
        <p class="text-gray-500 mb-8">
            Tu n'as pas les permissions nécessaires pour accéder à cette page.
        </p>
        <a href="{{ route('home') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700">
            Retour à la boutique
        </a>
    </div>
</x-app-layout>