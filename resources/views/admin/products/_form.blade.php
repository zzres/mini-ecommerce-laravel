<div class="mb-4">
    <label for="category_id" class="block font-medium mb-2">Catégorie</label>
    <select name="category_id" id="category_id"
            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('category_id') border-red-500 @enderror">
        <option value="">-- Choisir une categorie --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="name" class="block font-medium mb-2">Nom du produit</label>
    <input type="text" name="name" id="name" value=" {{ old('name', $product->name ?? '') }}"
            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('name') border-red-500 @enderror">
    @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="description" class="block font-medium mb-2">Description</label>
    <textarea name="description" id="description" rows"4"
              class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label for="price" class="block font-medium mb-2">Prix (€)</label>
        <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price ?? '') }}"
               class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('price') border-red-500 @enderror">
        @error('price')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="stock" class="block font-medium mb-2">Stock</label>
        <input type="number" name="stock" value="{{ old('stock', $product->stock ?? '') }}"
               class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('stock') border-red-500 @enderror">
        @error('stock')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mb-4">
    <label for="image" class="block font-medium mb-2">Image</label>

    @if (isset($product) && $product->image)
        <div class="mb-3">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-24 rounded border">
            <p>Image actuelle - laisse le champ vide pour la conserver</p>
        </div>
    @endif 

    <input type="file" name="image" id="image"
           class="w-full border rounded-lg p-3 @error('image') border-red-500 @enderror">
    @error('image')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>