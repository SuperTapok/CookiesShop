<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CookiesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PlacesController;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\ThemesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return $request->user();
});

Route::prefix('catalog')->group(function() {
    Route::post('add_product/', [CatalogController::class, 'add_product_api'])->name('add_product_api');
    Route::post('edit_product/', [CatalogController::class, 'edit_product_api'])->name('edit_product_api');
    Route::post('delete_product/{product_id}', [CatalogController::class, 'delete_product'])->name('delete_product_api');
    Route::post('hide_product/{product_id}', [CatalogController::class, 'hide_product'])->name('hide_product_api');
});

Route::prefix('cart')->group(function() {
    Route::post('{employee_id}/add_product/{product_id}', [CartController::class, 'add_product'])->name('add_to_cart');
    Route::post('{order_id}/delete_product/{product_id}', [CartController::class, 'delete_product'])->name('delete_from_cart');
    Route::post('{employee_id}/pay/{order_id}', [CartController::class, 'pay'])->name('pay');
});

Route::prefix('orders')->group(function() {
    Route::get('get_orders_by_employee/{employee_id}', [OrdersController::class, 'get_orders_by_employee'])
                ->name('get_orders_by_employee');
    Route::get('get_orders_by_code/{receipt_code}', [OrdersController::class, 'get_orders_by_code'])
                ->name('get_orders_by_code');
    Route::post('give_order/{order_id}', [OrdersController::class, 'give_order'])->name('give_order');
});

Route::prefix('activity')->group(function() {
    Route::post('delete_activity/{id}', [ActivityController::class, 'delete_activity'])->name('delete_activity');
    Route::post('edit_activity_api', [ActivityController::class, 'edit_activity_api'])->name('edit_activity_api');
    Route::post('add_activity_api', [ActivityController::class, 'add_activity_api'])->name('add_activity_api');
    Route::post('reward_employee_api', [ActivityController::class, 'reward_employee_api'])->name('reward_employee_api');
});

Route::prefix('provider')->group(function() {
    Route::post('delete_provider/{id}', [ProvidersController::class, 'delete_provider'])->name('delete_provider');
    Route::post('edit_provider_api', [ProvidersController::class, 'edit_provider_api'])->name('edit_provider_api');
    Route::post('add_provider_api', [ProvidersController::class, 'add_provider_api'])->name('add_provider_api');
});

Route::prefix('theme')->group(function() {
    Route::post('delete_theme/{id}', [ThemesController::class, 'delete_theme'])->name('delete_theme');
    Route::post('edit_theme_api', [ThemesController::class, 'edit_theme_api'])->name('edit_theme_api');
    Route::post('add_theme_api', [ThemesController::class, 'add_theme_api'])->name('add_theme_api');
});

Route::prefix('place')->group(function() {
    Route::post('delete_place/{id}', [PlacesController::class, 'delete_place'])->name('delete_place');
    Route::post('edit_place_api', [PlacesController::class, 'edit_place_api'])->name('edit_place_api');
    Route::post('add_place_api', [PlacesController::class, 'add_place_api'])->name('add_place_api');
});

Route::prefix('category')->group(function() {
    Route::post('delete_category/{id}', [CategoriesController::class, 'delete_category'])->name('delete_category');
    Route::post('edit_category_api', [CategoriesController::class, 'edit_category_api'])->name('edit_category_api');
    Route::post('add_category_api', [CategoriesController::class, 'add_category_api'])->name('add_category_api');
});

Route::prefix('favourite')->group(function() {
    Route::post('add_to_favourite/{employee_id}/{product_id}', [CatalogController::class, 'add_to_favourite_api'])->name('add_to_favourite_api');
    Route::post('delete_from_favourite/{employee_id}/{product_id}', [CatalogController::class, 'delete_from_favourite_api'])->name('delete_from_favourite_api');
});
