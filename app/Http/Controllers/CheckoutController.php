<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Ton panier est vide.');
        }

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|min:10',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Ton panier est vide.');
        }

        //Vérification du stock avant de commercer la transaction
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);

            if (!$product || $product->stock < $item['quantity']) {
                return redirect()->route('cart.index')
                    ->with('error', "Désolé, \"{$item['name']}\" n'est plus disponible en quantité suffisante.");
            }
        }

        $order = DB::transaction(function () use ($cart, $validated) {
            $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

            $order = Order::create([
                'user_id' => auth()->id(),
                'status' => 'pending',
                'total' => $total,
                'address' => $validated['address'],
            ]);

            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                ]);

                Product::find($productId)->decrement('stock', $item['quantity']);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()->route('checkout.confirmation', $order)->with('success', 'Commande passée avec succès !');
    }

    public function confirmation(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product');

        return view('checkout.confirmation', compact('order'));
    }
}
