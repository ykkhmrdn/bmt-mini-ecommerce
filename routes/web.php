<?php

use App\Http\Controllers\Api\ProductController as ApiProductController;
use App\Http\Controllers\Api\CartController as ApiCartController;
use App\Http\Controllers\Api\CheckoutController as ApiCheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('home');
})->name('home');

// API Routes
Route::prefix('api')->group(function () {
    Route::get('/products', [ApiProductController::class, 'index'])->name('api.products.index');
    Route::get('/products/{id}', [ApiProductController::class, 'show'])->name('api.products.show');

    Route::get('/cart', [ApiCartController::class, 'index'])->name('api.cart.index');
    Route::get('/cart/count', [ApiCartController::class, 'count'])->name('api.cart.count');
    Route::post('/cart/add', [ApiCartController::class, 'store'])->name('api.cart.add');
    Route::delete('/cart/{id}', [ApiCartController::class, 'destroy'])->name('api.cart.remove');

    Route::post('/checkout', [ApiCheckoutController::class, 'store'])->name('api.checkout');
});

// Web Routes for Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Web Routes for Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
