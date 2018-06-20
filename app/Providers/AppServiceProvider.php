<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Vinkla\Instagram\Instagram;
use Illuminate\Support\Facades\View;
use App\Product;
use App\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('partials.footer', function($view)
        {
            // Create a new instagram instance.
            $instagram = new Instagram('7071879134.1677ed0.8ddd57b0496d4f0494d739854a6deae2');

            $view->with('instagram', $instagram->media()); // you can pass array here aswell
        });
        View::composer('partials.product_preview', function($view)
        {
            $products = Product::inRandomOrder()->where('stock', '>', 0)->take(8)->get();

            $categories = Category::all();

            $view->with('products', $products)->with('categories', $categories); // you can pass array here aswell
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
