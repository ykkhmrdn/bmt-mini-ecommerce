<?php

use App\Http\Controllers\Api\ProductController as ApiProductController;
use App\Http\Controllers\Api\CartController as ApiCartController;
use App\Http\Controllers\Api\CheckoutController as ApiCheckoutController;
use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Api\AdminProductController as ApiAdminProductController;
use App\Http\Controllers\Api\FileUploadController as ApiFileUploadController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('home');
})->name('home');

// API Routes
Route::prefix('api')->group(function () {
    // Product APIs
    Route::get('/products', [ApiProductController::class, 'index'])->name('api.products.index');
    Route::get('/products/{id}', [ApiProductController::class, 'show'])->name('api.products.show');

    // Cart APIs
    Route::get('/cart', [ApiCartController::class, 'index'])->name('api.cart.index');
    Route::get('/cart/count', [ApiCartController::class, 'count'])->name('api.cart.count');
    Route::post('/cart/add', [ApiCartController::class, 'store'])->name('api.cart.add');
    Route::delete('/cart/{id}', [ApiCartController::class, 'destroy'])->name('api.cart.remove');

    // Checkout API
    Route::post('/checkout', [ApiCheckoutController::class, 'store'])->name('api.checkout');

    // Auth APIs
    Route::post('/auth/register', [ApiAuthController::class, 'register'])->name('api.auth.register');
    Route::post('/auth/login', [ApiAuthController::class, 'login'])->name('api.auth.login');

    // Protected Auth APIs
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [ApiAuthController::class, 'logout'])->name('api.auth.logout');
        Route::get('/auth/profile', [ApiAuthController::class, 'profile'])->name('api.auth.profile');

        // Admin Product Management APIs
        Route::prefix('admin')->group(function () {
            Route::get('/products', [ApiAdminProductController::class, 'index'])->name('api.admin.products.index');
            Route::post('/products', [ApiAdminProductController::class, 'store'])->name('api.admin.products.store');
            Route::get('/products/{id}', [ApiAdminProductController::class, 'show'])->name('api.admin.products.show');
            Route::put('/products/{id}', [ApiAdminProductController::class, 'update'])->name('api.admin.products.update');
            Route::delete('/products/{id}', [ApiAdminProductController::class, 'destroy'])->name('api.admin.products.destroy');
        });

        // File Upload APIs
        Route::post('/upload/product-image', [ApiFileUploadController::class, 'uploadProductImage'])->name('api.upload.product-image');
        Route::delete('/upload/product-image', [ApiFileUploadController::class, 'deleteProductImage'])->name('api.upload.delete-product-image');
    });
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Web Routes for Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Web Routes for Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
});

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
