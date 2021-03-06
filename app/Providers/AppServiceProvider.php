<?php

namespace App\Providers;

use App\Ad;
use App\Menu;
use App\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            
        $menus = Menu::where('deleted',0)->get();
            $view->with('menus', $menus);

        $ad_categories = Category::where('deleted',0)->get();
        $view->with('ad_categories',$ad_categories); 


        $feature_ad = Ad::where('deleted',0)->orderBy('created_at','desc')->first();
        $view->with('feature_ad',$feature_ad);

       
        });

       
        View::share('global_key', '123');

        Schema::defaultStringLength(191);
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
