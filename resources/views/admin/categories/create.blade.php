<x-admin-layout>
    <h1 class="text-2xl font-bold mb-6">Nouvelle catégorie</h1>

    <div class="bg-white rounded-lg shadow p-6 max-w-lg">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf 

            <label for="name" class="block font-medium mb-2">Nom de la catégorie</label>
            <input 
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                class="w-full border rounded-lg p-3 focus:ring-2 focus:outline-none @error('name') border-red-500 @enderror"
            >
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror 

            <div class="flex gap-3 mt-6">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700">
                    Créer
                </button>
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 rounded border hover:bg:-gray-50">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>