<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Produits</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Nouveau produit 
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full text-left min-w-[600px]">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-600"></th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">Nom</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">Catégorie</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">Prix</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">Stock</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-600 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="border-b last:border-0">
                        <td class="px-6 py-4">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 object-cover rounded">
                            @else 
                                <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">-</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $product->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $product->category->name }}</td>
                        <td class="px-6 py-4">{{ number_format($product->price, 2) }} €</td>
                        <td class="px-6 py-4">
                            <span class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:underline">Modifier</a>

                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Supprimer ce produit ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button> 
                            </form>
                        </td>
                    </tr>
                @empty 
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">Aucun produit pour l'instant.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</x-admin-layout>