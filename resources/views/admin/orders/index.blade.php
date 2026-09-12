<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Commandes</h1>

        <form action="GET" class="flex gap-2">
            <select name="status" onchange="this.form.submit()" class="border rounded-lg px-3 py-2">
                <option value="">Tous les status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Expédiée</option>
                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Livrée</option>
            </select>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">N°</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">Client</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">Date</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">Total</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">Status</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-600 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr class="border-b last:border-0">
                        <td class="px-6 py-4">#{{ $order->id }}</td>
                        <td class="px-6 py-4">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $order->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 font-medium">{{ number_format($order->total, 2) }} €</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                                @csrf 
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()"
                                        class="text-sm rounded-full px-3 py-1 border-0
                                        {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $order->status === 'shipped' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $order->status === 'delivered' ? 'bg-green-100 text-green-700' : '' }}">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>En attente</option>
                                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Expédiée</option>
                                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Livrée</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 hover:underline">Voir détail</a>
                        </td>
                    </tr>
                @empty 
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">Aucune commande pour l'instant.</td>
                    </tr>
                @endforelse 
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $orders->appends(request()->query())->links() }}
    </div>
</x-admin-layout>