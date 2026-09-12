<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Nos produits</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="border rounded-lg p-4 shadow hover:shadow-lg transition">
                    <div class="h-48 bg-gray-200 mb-4 flex items-center justify-center rounded">
                        @if ($product->image)
                            <img src="{{asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full object-cover rounded">
                        @else
                            <span class="text-gray-400">Pas d'image</span>
                        @endif
                    </div>

                    <span class="text-xs text-gray-500 uppercase">{{ $product->category->name }}</span>
                    <h2 class="text-lg font-semibold mt-1">{{ $product->name }}</h2>
                    <p class="text-gray-600 text-sm mt-1">{{ Str::limit($product->description, 60) }}</p>

                    <div class="flex justify-between items-center mt-4">
                        <span class="flex justify-between items-center mt-4">{{ number_format($product->price, 2) }} €</span>
                        <span class="text-sm {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stock > 0 ? 'En stock' : 'Rupture' }}
                        </span>
                    </div>

                    <button
                        x-data="{ loading: false}"
                        @click="
                            loading = true;
                            fetch(`{{ route('cart.add', $product) }}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(res => res.json())
                            .then(data => {
                                window.dispatchEvent(new CustomEvent('cart-updated', { detail: data.cartCount }));
                                loading = false;
                            })
                        "

                        :disabled="loading || {{ $product->stock <= 0 ? 'true' : 'false' }}"
                        class="mt-3 w-full bg-indigo-600 text-gris font-semibold py-2 rounded-lg shadow-md hover:bg-indigo-700 hover:shadow-lg active:scale-95 transition-all duration-150 disabled:opacity-50 disabled:cursor-not-allowed disabled:shadow-none"
                    >
                        <span x-show="!loading" class="flex items-center justify-center gap-2">
                           🛒 {{ $product->stock > 0 ? 'Ajouter au panier' : 'Indisponible'}}
                        </span>
                        <span x-show="loading">Ajout...</span>
                    </button>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>