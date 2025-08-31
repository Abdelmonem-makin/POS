<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['register'=> false]);

// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

use App\Http\Controllers\InventoryController;

Route::middleware(['auth'])->group(function () {
	Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
	Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');
	Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
	Route::get('/inventory/report', [InventoryController::class, 'report'])->name('inventory.report');
});
