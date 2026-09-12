<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-8">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6 text-center font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="text-centern mb-8">
            <div class="text-5xl mb-4">✅</div>
            <h1 class="text-2xl font-bold">Merci pour votre commande</h1>
            <p class="text-gray-500 mt-1">Commande n°{{ $order->id }}</p>
        </div>

        <div class="bg-gray-50 rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Détails de la commande</h2>

            @foreach ($order->items as $item)
                <div class="flex justify-between py-2 border-b last:border-0">
                    <span>{{ $item->product->name }} <span class="text-gray-500">x{{ $item->quantity }}</span>
                    <span class="font-medium">{{ number_format($item->unit_price * $item->quantity, 2) }} €</span>
                </div>
            @endforeach

            <div class="flex justify-between pt-4 mt-2 border-t font-bold text-lg">
                <span>Total</span>
                <span class="text-indigo-600">{{ number_format($order->total, 2) }} €</span>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700">
                Retour à la boutique
            </a>
        </div>
    </div>
</x-app-layout>