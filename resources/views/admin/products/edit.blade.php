<x-admin-layout>
    <h1 class="text-2xl font-bold mb-6">Modifier le produit</h1>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PUT')

            @include('admin.products._form')

            <div class="flex gap-3 mt-6">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700">
                    Mettre à jour
                </button>
                <a href="{{ route('admin.products.index') }}" class="px-6 py-3 rounded border hover:bg-gray-50">
                    Annuler 
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>