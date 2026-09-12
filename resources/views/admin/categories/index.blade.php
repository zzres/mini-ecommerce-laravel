<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Catégories</h1>
        <a href="{{ route('admin.categories.create') }}" class="bg-indigo-600 text px-4 py-2 rounded hover:bg-indigo-700">
            + Nouvelle categorie 
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border">
                <tr>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">Nom</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">Produits liés</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-600 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-b last:border-0">
                        <td class="px-6 py-4">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $category->products_count }}</td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 hover:underline">Modifier</a>

                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Supprimer cette catégorie ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button> 
                            </form>
                        </td>
                    </tr>
                @empty 
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">Aucune catégorie pour l'instant.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</x-admin-layout>