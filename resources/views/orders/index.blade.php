<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Mes commandes</h1>

        @if ($orders->isEmpty())
            <div class="text-center py-12 text-gray-500">
                <p>Vous n'avez pas encore passé de commande</p>
                <a href="{{ route('home') }}" class="text-indigo-600 hover:underline">Voir les produits</a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($orders as $order)
                    <a href="{{ route('checkout.confirmation', $order) }}" class="block bg-gray-50 hover:bg-gray-100 rounded-lg p-5 transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="front-semibold">Commande n°{{ $order->id }}</p>
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y à H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-indigo-600">{{ number_format($order->total, 2) }} €</p>
                                <span class="text-xs px-2 py-1 rounded-full
                                    {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $order->status === 'shipped' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $order->status === 'delivered' ? 'bg-green-100 text-green-700' : '' }}">
                                    {{ $order->status }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</x-app-layout>