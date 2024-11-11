<?php

namespace App\Providers;

use App\Models\Area;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.pagination');

        Schema::defaultStringLength(191);

        View::composer('admin.*', function ($view) {
            $menus = Menu::with('childs')->where('parent_id', 0)->get();
            $view->with('menus', $menus);
        });

        View::composer('*', function ($view) {
            $view->with('categories', Category::getParentCategories());
            $view->with('areas', Area::getActiveAreas());
        });
    }
}
