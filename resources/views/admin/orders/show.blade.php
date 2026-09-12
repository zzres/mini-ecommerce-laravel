<x-admin-layout>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.orders.index') }}" class="text-gray-500 hover:text-gray-700"><- Retour</a>
        <h1 class="text-2xl font-bold">Commande n°{{ $order->id }}</h1>
    </div>

    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="col-span-2 bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold mb-4">Articles commandés</h2>

            @foreach ($order->items as $item)
                <div class="flex justify-between py-2 border-b last:border-0">
                    <span>{{ $item->product->name ?? 'Produit supprimé' }} </span>
                    <span class="font-medium">{{ number_format($item->unit_price * $item->quantity, 2) }} €</span>
                </div>
            @endforeach 

            <div class="flex justify-between pt-4 mt-2 border-t font-bold text-lg">
                <span>Total</span>
                <span class="text-indigo-600">{{ number_format($order->total, 2) }} €</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold mb-3">Client</h2>
            <p class="text-gray-700">{{ $order->user->name }}</p>
            <p class="text-gray-500 text-sm">{{ $order->user->email }}</p>
            
            <h2 class="font-semibold mt-6 mb-3">Adresse de livraison</h2>
            <p class="text-gray-700 text-sm">{{ $order->user->email }}</p>

            <h2 class="font-semibold mt-6 mb-3">Status</h2>
            <form action="{{ route('admin.orders.update', $order ) }}" method="POST">
                @csrf 
                @method('PATCH')
                <select name="status" onchange="this.form.submit()" class="w-full border rounded-lg px-3 py-2">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Expédiée</option>
                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Livrée</option>
                </select>
            </form>
        </div>
    </div>
</x-admin-layout>