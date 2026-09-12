<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Passer commande</h1>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-gray-50 rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Récapitulatif de commande</h2>

            @foreach ($cart as $item)
                <div class="flex jutify-between py-2 border-b last:border-0">
                    <span>{{ $item['name'] }} <span class="text-gray-500">x{{ $item['quantity'] }}</span></span>
                    <span class="font-medium">{{ number_format($item['price'] * $item['quantity'], 2) }} €</span>
                </div>
            @endforeach

            <div class="flex justify-between pt-4 mt-2 border-t font-bold text-lg">
                <span>Total</span>
                <span class="text-indigo-600">{{ number_format($total) }} €</span>
            </div>
        </div>

        <form method="POST" action="{{ route('checkout.store') }}">
            @csrf
            
            <label for="address" class="block font-medium mb-2">Adresse de livraison</label>
            <textarea
                name="address"
                id="address"
                rows="4"
                class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('address') border-red-500 @enderror"
            >{{ old('address') }}</textarea>
            @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <button type="submit" class="mt-6 w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700 transition">
                Valider la commande
            </button>
        </form>
    </div>
</x-app-layout>