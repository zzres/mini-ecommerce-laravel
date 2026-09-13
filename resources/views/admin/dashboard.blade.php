<x-admin-layout>
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-sm text-gray-500">Commandes totales</p>
            <p class="text-3xl font-bold mt-1">{{ $stats['totalOrders'] }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-sm text-gray-500">CA ce mois-ci</p>
            <p class="text-3xl font-bold mt-1 text-indigo-600">{{ number_format($stats['monthlyRevenue'], 2) }} €</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-sm text-gray-500">Commandes en attente</p>
            <p class="text-3xl font-bold mt-1 text-yellow-600">{{ $stats['pendingOrders'] }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-sm text-gray-500">Produits en rupture</p>
            <p class="text-3xl font-bold mt-1 {{ $stats['lowStockProducts'] > 0 ? 'text-red-600' : 'text-gray-400' }}">
                {{ $stats['lowStockProducts'] }}
            </p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="font-semibold mb-4">Commandes récentes</h2>

        @forelse ($recentOrders as $order)
            <a href="{{ route('admin.orders.show', $order) }}" class="flex justify-between items-center py-3 border-b last:border-0 hover:bg-gray-50 -mx-2 px-2 rounded">
                <div>
                    <p class="font-medium">#{{ $order->id }} — {{ $order->user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                </div>
                <span class="font-semibold text-indigo-600">{{ number_format($order->total, 2) }} €</span>
            </a>
        @empty
            <p class="text-gray-500">Aucune commande pour l'instant.</p>
        @endforelse
    </div>
</x-admin-layout>