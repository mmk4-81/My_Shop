<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderAController;
use App\Http\Controllers\Admin\ProductAController;
use App\Http\Controllers\Admin\ShopAController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Home\CategoriesController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Products\productPageController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Seller\AttributeSController;
use App\Http\Controllers\Seller\CategorySController;
use App\Http\Controllers\Seller\DashboardSController;
use App\Http\Controllers\Seller\OrderSController;
use App\Http\Controllers\Seller\ProductImageController;
use App\Http\Controllers\Seller\ProductSController;
use App\Http\Controllers\Seller\ShopSController;
use App\Http\Controllers\Shop\FollowingController;
use App\Http\Controllers\Shop\ShopPageController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/test', function () {
    dd(session('cart'));
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories/{category:slug}', [CategoriesController::class, 'show'])->name('home.category.show');
Route::get('/dashboard', [ProfileController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::resource('shops', ShopPageController::class)->only(['index', 'show']);

Route::get('/shops/search', [ShopPageController::class, 'search_shops'])->name('shops.search');
Route::get('/products/{product:slug}', [productPageController::class, 'show'])->name('home.products.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::resource('shops', ShopPageController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('shops', ShopPageController::class)->only(['create', 'store']);
    Route::post('/follow/{shop}', [FollowingController::class, 'follow'])->name('shops.follow');
    Route::post('/unfollow/{shop}', [FollowingController::class, 'unfollow'])->name('shops.unfollow');
    Route::get('/cart/show', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'adupdated'])->name('cart.update');
});


Route::middleware(['auth', 'admin'])->prefix('admin-panel')->name('admin.')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::put('users/updateCredit/{user}', [UserController::class, 'updateCredit'])->name('users.updateCredit');
    Route::put('users/updateRole/{user}', [UserController::class, 'updateRole'])->name('users.updateRole');
    Route::resource('shops', ShopAController::class);
    Route::resource('products', ProductAController::class);
    Route::get('/products/{product}', [ProductAController::class, 'show'])->name('products.show');
    Route::post('products/{product}/disable', [ProductAController::class, 'disable'])->name('products.disable');
    Route::resource('orders', OrderAController::class);

});


Route::middleware(['auth', 'seller'])->prefix('seller-panel')->name('seller.')->group(function () {
    Route::resource('dashboard', DashboardSController::class);
    Route::resource('attributes', AttributeSController::class);
    Route::resource('categories', CategorySController::class);
    Route::resource('myshop', ShopSController::class);
    Route::resource('products', ProductSController::class);
    Route::get('products/{product}/category-edit', [ProductSController::class, 'editCategory'])->name('products.category.edit');
    Route::put('products/{product}/category-update', [ProductSController::class, 'updateCategory'])->name('products.category.update');
    Route::get('products/{product}/images-edit', [ProductImageController::class, 'edit'])->name('products.images.edit');
    Route::delete('products/{product}/images-destroy', [ProductImageController::class, 'destroy'])->name('products.images.destroy');
    Route::put('products/{product}/images-set-primary', [ProductImageController::class, 'setPrimary'])->name('products.images.set_primary');
    Route::post('products/{product}/images-add', [ProductImageController::class, 'add'])->name('products.images.add');
    Route::resource('orders', OrderSController::class);
    Route::get('/category-attributes/{category}', [CategoryController::class, 'getCategoryAttributes']);
});


