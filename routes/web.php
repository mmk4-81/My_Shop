<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Seller\AttributeSController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Seller\CategorySController;
use App\Http\Controllers\Seller\DashboardSController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home']);


Route::get('/dashboard', function () {
    return view('home/index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::middleware(['auth'])->group(function () {
    /* create shop */
    Route::get('/shops/create', [ShopController::class, 'create'])->name('shops.create');
    Route::post('/shops/store', [ShopController::class, 'store'])->name('shops.store');
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
   Route::resource('shops', \App\Http\Controllers\Admin\ShopController::class);

});

Route::middleware(['auth', 'seller'])->prefix('seller-panel')->name('seller.')->group(function () {

  Route::resource('dashboard', DashboardSController::class);
  Route::resource('attributes', AttributeSController::class);
  Route::resource('categories', CategorySController::class);

});

Route::middleware(['auth', 'admin_or_seller'])->group(function () {
    Route::prefix('admin-panel')->group(function () {
    });


    Route::prefix('seller-panel')->group(function () {
    });

});
