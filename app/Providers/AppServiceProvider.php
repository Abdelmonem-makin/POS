<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\stock;
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
            $lowStock = Product::whereColumn('Quantity', '<=', 'minimum_Quantity')->with('Categorie')->get();
            $view->with('lowStock', $lowStock);
        });

        view()->composer('*', function ($view) {
            $product = stock::with(['Product' => function ($query) {
                $query->wherePivotBetween('expir_data', [now(), now()->addDays(7)])->with('Categorie');
            }])->get();
            $products = $product->flatMap->Product->filter();
            $view->with('products', $products);
        });



        Paginator::useBootstrapFive();
        //
        Paginator::useBootstrapFive();
    }
}
