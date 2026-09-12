<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(4);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }
}
