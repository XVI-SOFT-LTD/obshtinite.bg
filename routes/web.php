<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandmarkController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ParliamentaryGroupController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', [HomeController::class, 'homepage'])->name('homepage');

// OLD
// OLD
// OLD
// OLD
// OLD
// OLD
// OLD
// OLD
// OLD
// OLD
// OLD
// OLD
// OLD

Route::get('/category/{slug}', [NewsController::class, 'showCategory'])->name('category.show');
Route::get('/news/{id}-{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/news', [NewsController::class, 'list'])->name('news.listing');

/* Search */
Route::post('/search', [SearchController::class, 'postSearch'])->name('search.post');
Route::get('/search', [SearchController::class, 'search'])->name('search.get');

/* Static pages */
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');
Route::get('/listing/{categoryName}', [PageController::class, 'listCategory'])->name('category.listing.layout');

Route::get('/obshtinite/{id}', [PageController::class, 'municipality'])->name('municipality');
Route::get('/oblasti/{id}', [PageController::class, 'area'])->name('area');

/* Municipality */
Route::get('/municipality/{slug}-{id}', [MunicipalityController::class, 'show'])->name('municipality.show');

/* Area */
Route::get('/area/{slug}', [AreaController::class, 'show'])->name('area.show');

/* Landmark */
Route::get('/landmarks', [LandmarkController::class, 'listAllLandmarks'])->name('landmark.listAllLandmarks');
Route::get('/landmark/{slug}-{id}', [LandmarkController::class, 'show'])->name('landmark.show');

/* Parliamentary Group */
Route::get('/parliamentary-group/{slug}-{id}', [ParliamentaryGroupController::class, 'show'])->name('parliamentaryGroup.show');
Route::get('/parliamentary-groups', [ParliamentaryGroupController::class, 'show'])->name('parliamentaryGroup.list');

/* OLD */

Route::get('/loginadmin', [HomeController::class, 'loginadmin'])->name('loginadmin');

Route::get('lang/{locale}', [LanguageController::class, 'switchLang'])->name('lang.switch');
Route::get('/translations/{locale}', [LanguageController::class, 'getTranslations'])->name('translations.get');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */

Route::get('/test', function () {
    Artisan::call('get-external-news');
});

require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';
