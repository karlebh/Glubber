<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Services\Cart;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
  return Inertia::render('Welcome', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
  ]);
});

Route::get('/dashboard', function () {
  return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/product', ProductController::class);

Route::get('/cart', function () {
  $cart = new Cart();
  $cart->add([
    'id' => 2,
    'name' => "power bank",
    'price' => '50k in jesus name!',
    'count' => 1,
  ]);
  $cart->add([
    'id' => 2,
    'name' => "power bank",
    'price' => '50k in jesus name!',
    'count' => 1
  ]);
  $cart->add([
    'id' => 2,
    'name' => "power bank",
    'price' => '50k in jesus name!',
    'count' => 1
  ]);
  // $cart->clearAll();
  $cart->add([
    'id' => 3,
    'name' => "phone",
    'price' => 'free in jesus name!',
    'count' => 1
  ]);
  // $cart->add([
  //   'id' => 3,
  //   'name' => "phone",
  //   'price' => 'free in jesus name!',
  //   'count' => 1
  // ]);

  $cart->remove([
    'id' => 3,
    'name' => "phone",
    'price' => 'free in jesus name!',
    'count' => 1
  ]);

  return [$cart->cart, $cart->product_ids];
})->name('cart');










require __DIR__ . '/auth.php';
