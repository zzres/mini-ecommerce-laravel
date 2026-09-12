<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', AdminCategoryController::class)->except(['show']);
    Route::resource('products', AdminProductController::class)->except(['show']);
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');
});

//Protéger la route checkout
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/commande', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/commande', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/commande/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
    Route::get('/mes-commandes', [OrderController::class, 'index'])->name('my-orders.index');
});

Route::get('/panier', [ CartController::class, 'index'])->name('cart.index');
Route::post('/panier/ajouter/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/panier/modifier/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/panier/supprimer/{productId}', [CartController::class, 'remove'])->name('cart.remove');

require __DIR__.'/auth.php';
