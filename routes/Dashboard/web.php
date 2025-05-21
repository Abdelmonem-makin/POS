<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;


Route::middleware(['auth:sanctum','verified'])->group(function () {

    Route::get('/', [Controller::class , 'index'])->name('Home');
    Route::resource('dashboard',DashboardController::class)->except(['show']);
    route::group(['prefix'=>'dashboard'],function(){
        Route::get('Order/{id}/show_product_order',[OrderController::class , 'show_product_order'])->name('show-product-order');
        Route::resource('User', UsersController::class)->except(['show']);
        Route::resource('Product', ProductController::class)->except(['show']);
        Route::resource('Order', OrderController::class)->except(['show']);
        Route::get('Product_chaneg_Status/{id}', [ProductController::class,'chaneg_Status'])->name('Product_chaneg_Status');
        // Route::resource('dashboard',DashboardController::class);
        Route::resource('Category', CategoryController::class);
        Route::get('Category_chaneg_Status/{id}', [CategoryController::class,'chaneg_Status'])->name('Category_chaneg_Status');
    });
});
