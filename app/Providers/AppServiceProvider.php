<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
                view()->composer('*', function ($view) {
        $lowStock = Product::whereColumn('Quantity', '<=', 'minimum_Quantity')->get();
        $view->with('lowStock', $lowStock);

                });



        Paginator::useBootstrapFive();
        //
        Paginator::useBootstrapFive();
    }
}
