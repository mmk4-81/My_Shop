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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories/{category:slug}', [CategoriesController::class, 'show'])->name('home.category.show');
Route::get('/dashboard', function () { return view('home/index');})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/shops', [ShopPageController::class, 'index']);
Route::get('/shops/search', [ShopPageController::class, 'search_shops'])->name('shops.search');
Route::get('/products/{product:slug}', [productPageController::class, 'show'])->name('home.products.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('shops', ShopPageController::class)->only(['index', 'show']);
    Route::post('/follow/{shop}', [FollowingController::class, 'follow'])->name('shops.follow');
    Route::post('/unfollow/{shop}', [FollowingController::class, 'unfollow'])->name('shops.unfollow');
    Route::resource('cart', CartController::class);

});

// Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//     /* admin dashboard */
//     Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
//     /* admin users */
//     Route::get('/view_users', [UserController::class, 'view_users']);
//     Route::get('/search_user', [UserController::class, 'search_user']);
//     Route::post('/update_credit/{id}', [UserController::class, 'updateCredit']);
//     Route::get('/delete_users/{id}', [UserController::class, 'deleteUser'])->name('admin.delete_user');
//     Route::get('/add_user', [UserController::class, 'showAddUserForm'])->name('admin.show_add_user_form');
//     Route::post('/add_user', [UserController::class, 'storeUser'])->name('admin.store_user');
//     Route::get('/edit_user/{id}', [UserController::class, 'editUser'])->name('admin.edit_user');
//     Route::post('/update_user/{id}', [UserController::class, 'updateUser'])->name('admin.update_user');
//     Route::post('/update_role/{id}', [UserController::class, 'updateRole'])->name('admin.update_role');

//     /* view latest products in homepage */
//     Route::get('/latest-products', [ProductController::class, 'latestProducts']);
//     /* admin products */
//     Route::get('/view_product', [ProductController::class, 'view_product']);
//     Route::get('/search_product', [ProductController::class, 'search_product']);
// });

// Route::middleware(['auth', 'seller'])->prefix('seller')->group(function () {
//     /* seller dashboard */
//     Route::get('/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
//     /* seller product */
//     Route::get('/add_product', [AdminController::class, 'add_product']);
//     Route::post('/upload_product', [AdminController::class, 'upload_product']);
// });

// Route::middleware(['auth', 'admin_or_seller'])->group(function () {
//     /* users */
//     Route::get('/dashboardlayout', [AdminController::class, 'getusers']);

//     Route::prefix('admin')->group(function () {
//         /* attribute */
//         Route::resource('attribute', AttributeController::class);
//         /* category */
//         Route::get('/view_category', [CategoryController::class, 'view_category']);
//         Route::post('/add_category', [CategoryController::class, 'add_category']);
//         Route::get('/delete_category/{id}', [CategoryController::class, 'delete_category']);
//         Route::get('/edit_category/{id}', [CategoryController::class, 'edit_category']);
//         Route::post('/update_category/{id}', [CategoryController::class, 'update_category']);
//         /* product */
//         Route::get('/delete_products/{id}', [ProductController::class, 'delete_products']);
//         Route::get('/edit_products/{id}', [ProductController::class, 'edit_products']);
//         Route::post('/update_products/{id}', [ProductController::class, 'update_products']);
//     });

//     Route::prefix('seller')->group(function () {
//         /* attribute */
//         Route::resource('attribute', AttributeController::class);
//          /* category */
//         Route::get('/view_category', [CategoryController::class, 'view_category']);
//         Route::post('/add_category', [CategoryController::class, 'add_category']);
//         Route::get('/delete_category/{id}', [CategoryController::class, 'delete_category']);
//         Route::get('/edit_category/{id}', [CategoryController::class, 'edit_category']);
//         Route::post('/update_category/{id}', [CategoryController::class, 'update_category']);
//     });
// });


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


Route::middleware(['auth', 'admin_or_seller'])->group(function () {
    Route::prefix('admin-panel')->group(function () {
    });


    Route::prefix('seller-panel')->group(function () {
    });

});

