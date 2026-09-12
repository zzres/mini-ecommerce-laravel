<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return $this->cartResponse($cart);
    }

    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = max(1, (int) $request->quantity);
            session()->put('cart', $cart);
        }

        return $this->cartResponse($cart);
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);

        return $this->cartResponse($cart);
    }

    private function cartResponse(array $cart)
    {
        return response()->json([
            'success' => true,
            'cart' => $cart,
            'cartCount' => array_sum(array_column($cart, 'quantity')),
            'total' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)),
        ]);
    }
}
