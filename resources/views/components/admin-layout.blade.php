<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0">
            <div class="p-6 text-xl font-bold border-b border-gray-800">
                Espace Admin
            </div>

            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600' : 'hover:bg-gray-800' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.categories.index') }}"
                    class="block px-4 py-2 rounded {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-600' : 'hover:bg-gray-800' }}">
                    Catégories
                </a>

                <a href="{{ route('admin.products.index') }}" 
                    class="block px-4 py-2 rounded {{ request()->routeIs('admin.products.*') ? 'bg-indigo-600' : 'hover:bg-gray-800' }}">
                    Produits
                </a>

                {{-- Les liens suivants seront activés une fois les routes créées --}}
                <a href="{{ route('admin.orders.index') }}"
                    class="block px-4 py-2 rounded {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-600' : 'hover:bg-gray-800' }}">
                    Commandes
                </a>

            </nav>

            <div class="p-4 mt-auto border-t border-gray-800">
                <a href=" {{ route('home') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white">
                    ← retour au site
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-400 hover:text-text">
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        {{-- Contenu principal --}}
        <main class="flex-1 p-8">
            @if (session('success'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif 

            {{ $slot }}
        </main>
    </div>
</body>
</html>