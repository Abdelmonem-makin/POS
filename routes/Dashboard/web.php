<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\PaymentController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ShiftController;
use App\Http\Controllers\Dashboard\StockController;
use App\Http\Controllers\Dashboard\SupplierController as DashboardSupplierController;
use App\Http\Controllers\Dashboard\SupplierController;


Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/', [Controller::class, 'index'])->name('Home');
    Route::resource('dashboard', DashboardController::class)->except(['show']);
    route::group(['prefix' => 'dashboard'], function () {
        Route::get('Order/{id}/show_product_order', [OrderController::class, 'show_product_order'])->name('show-product-order');
        Route::resource('User', UsersController::class)->except(['show']);
        Route::resource('Product', ProductController::class);
        Route::get('/alertLowProduct',[ ProductController::class , 'getLowStockAlerts']);
        Route::resource('Order', OrderController::class)->except(['show']);
        Route::get('Order_incame', [OrderController::class,'Order_incame'])->name('Order_incame');
        Route::get('Product_chaneg_Status/{id}', [ProductController::class, 'chaneg_Status'])->name('Product_chaneg_Status');
        // Route::resource('dashboard',DashboardController::class);
        Route::resource('Category', CategoryController::class)->except(['show']);
        Route::get('Category_chaneg_Status/{id}', [CategoryController::class, 'chaneg_Status'])->name('Category_chaneg_Status');

        Route::resource('Stock', StockController::class)->except(['show']);
        Route::resource('supplier', SupplierController::class)->except(['show']);
        Route::resource('Shift', ShiftController::class)->except(['show']);
        Route::resource('Payment', PaymentController::class)->except(['show']);

        Route::get('Stock_chaneg_Status/{id}', [StockController::class, 'Stock_Status'])->name('Stock_chaneg_Status');
    });
});
