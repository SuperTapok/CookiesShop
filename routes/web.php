<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PlacesController;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\ThemesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::middleware('auth')->group(function(){
    Route::redirect('', 'catalog', 301);
    
    Route::prefix('catalog')->group(function() {
        Route::get('category/{category_name?}', [CatalogController::class, 'category'])->name('category');
        Route::get('theme/{theme_name?}', [CatalogController::class, 'theme'])->name('theme');
        Route::get('add_product', [CatalogController::class, 'add_product'])->name('add_product');
        Route::get('detail/{product_id}', [CatalogController::class, 'detail'])->name('detail');
        Route::get('edit_product/{product_id}', [CatalogController::class, 'edit_product'])->name('edit_product');

        Route::get('', [CatalogController::class, 'index'])->name('catalog');
    });

    Route::prefix('manage_categories')->group(function() {
        Route::get('add_category', [CategoriesController::class, 'add_category'])->name('add_category');
        Route::get('edit_category/{id}', [CategoriesController::class, 'edit_category'])->name('edit_category');
        Route::get('', [CategoriesController::class, 'index'])->name('manage_categories');
    });

    Route::prefix('manage_providers')->group(function() {
        Route::get('add_provider', [ProvidersController::class, 'add_provider'])->name('add_provider');
        Route::get('edit_provider/{id}', [ProvidersController::class, 'edit_provider'])->name('edit_provider');
        Route::get('', [ProvidersController::class, 'index'])->name('manage_providers');
    });

    Route::prefix('manage_themes')->group(function() {
        Route::get('add_theme', [ThemesController::class, 'add_theme'])->name('add_theme');
        Route::get('edit_theme/{id}', [ThemesController::class, 'edit_theme'])->name('edit_theme');
        Route::get('', [ThemesController::class, 'index'])->name('manage_themes');
    });

    Route::prefix('manage_places')->group(function() {
        Route::get('add_place', [PlacesController::class, 'add_place'])->name('add_place');
        Route::get('edit_place/{id}', [PlacesController::class, 'edit_place'])->name('edit_place');
        Route::get('', [PlacesController::class, 'index'])->name('manage_places');
    });

    Route::get('cart', [CartController::class, 'index'])->name('cart');

    Route::get('transactions', [TransactionsController::class, 'index'])->name('transactions');

    Route::get('orders', [OrdersController::class, 'index'])->name('orders');

    Route::prefix('manage_activities')->group(function() {
        Route::get('add_activity', [ActivityController::class, 'add_activity'])->name('add_activity');
        Route::get('edit_activity/{id}', [ActivityController::class, 'edit_activity'])->name('edit_activity');
        Route::get('reward_employee', [ActivityController::class, 'reward_employee'])->name('reward_employee');
        Route::get('', [ActivityController::class, 'index'])->name('manage_activities');
    });


    Route::get('profile', [ProfileController::class, 'index'])->name('profile');

    Route::get('logout', [LogoutController::class, 'perform'])->name('logout');

    Route::get('order', [CartController::class,'getOrderPdf'])->name('get_order');;

    Route::fallback(function () {
        return redirect('');
    });
});
