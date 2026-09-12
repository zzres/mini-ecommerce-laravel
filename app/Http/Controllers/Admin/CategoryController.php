<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $validated['name'],
            'slug' => str()->slug($validated['name']),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $validated['name'],
            'slug' => str()->slug($validated['name']),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie mise à jour.');
    }

    /**
     * Remove the specified resource from storage. string $id
     */
    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return redirect()->route('admin.categories.index')->with('error', 'Impossible de supprimer : des produits sont liés à cette catégorie.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie supprimée');
    }
}
