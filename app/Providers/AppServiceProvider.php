<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\News;
use App\Models\Menu;
use App\Models\Category;

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
            $view->with('popularNews', News::getPopularNews());
            $view->with('categories', Category::getParentCategories());
        });
    }
}
