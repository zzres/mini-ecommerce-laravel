<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8"
        x-data="{
            cart: {{ Illuminate\Support\Js::from($cart) }},
            total: {{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)) }},

            get cartEntries() {
                return Object.entries(this.cart);
            },

            updateQuantity(productId, quantity) {
                if (quantity < 1) return;

                fetch(`/panier/modifier/${productId}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ quantity })
                })
                .then(res => res.json())
                .then(data => {
                    this.cart = data.cart;
                    this.total = data.total;
                    window.dispatchEvent(new CustomEvent('cart-updated', { detail: data.cartCount }));
                });
            },

            removeItem(productId) {
                fetch(`/panier/supprimer/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.cart = data.cart;
                    this.total = data.total;
                    window.dispatchEvent(new CustomEvent('cart-updated', { detail: data.cartCount }));
                });
            }
        }">

        <h1 class="text-3xl font-bold mb-6">Mon panier</h1>

        <div x-show="cartEntries.length === 0" class="text-center py-12 text-gray-500">
            <p>Ton panier est vide.</p>
            <a href="{{ route('home') }}" class="text-indigo-600 hover:underline">Retourner aux produits</a>
        </div>

        <div x-show="cartEntries.length > 0">
            <template x-for="[productId, item] in cartEntries" :key="productId">
                <div class="flex items-center justify-between border-b py-4">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center text-xs text-gray-400">
                            IMG
                        </div>
                        <div>
                            <p class="font-semibold" x-text="item.name"></p>
                            <p class="text-sm text-gray-500" x-text="item.price + ' € l\'unité'"></p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button
                            @click="updateQuantity(productId, item.quantity - 1)"
                            class="w-8 h-8 border rounded hover:bg-gray-100"
                        >-</button>

                        <span x-text="item.quantity" class="w-6 text-center"></span>

                        <button 
                            @click="updateQuantity(productId, item.quantity + 1)"
                            class="w-8 h-8 border rounded hover:bg-gray-100"
                        >+</button>
                    </div>

                    <p class="font-semiblod w-20 text-right" x-text="(item.price * item.quantity).toFixed(2) + ' €'"></p>

                    <button
                        @click="removeItem(productId)"
                        class="text-red-500 hover:text-red-700 text-sm ml-4"
                    >
                        supprimer
                    </button>
                </div>
            </template>

            <div class="flex justity-between items-center mt-6 pt-4 border-t">
                <span class="text-xl font-bold">Total</span>
                <span class="text-xl font-bold text-indigo-600" x-text="total.toFixed(2) + ' €'"></span>
            </div>

            <div class="mt-6 text-right">
                <a href="{{ route('checkout.index') }}" class="inline-block bg-white text-green-600 px-6 py-3 rounded hover:bg-indigo-700">
                    Passer commande
                </a>
            </div>
        </div>
    </div>
</x-app-layout>