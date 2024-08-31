<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\HomeController;

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
Route::get('/category/{slug}', [NewsController::class, 'showCategory'])->name('category.show');
Route::get('/news/{id}-{slug}', [NewsController::class, 'show'])->name('news.show');

/* Search */
Route::post('/search', [SearchController::class, 'postSearch'])->name('search.post');
Route::get('/search', [SearchController::class, 'search'])->name('search');

/* Static pages */
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');

Route::get('/obshtinite/{id}', [PageController::class, 'municipality'])->name('municipality');
Route::get('/oblasti/{id}', [PageController::class, 'area'])->name('area');

/* OLD */

Route::get('/category', [HomeController::class, 'category'])->name('category');

Route::get('/video', [HomeController::class, 'video'])->name('video');
Route::get('/single-video.html', [HomeController::class, 'video'])->name('video');

Route::get('/audio', [HomeController::class, 'audio'])->name('audio');
Route::get('/single-audio.html', [HomeController::class, 'audio'])->name('audio');

Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/single-gallery.html', [HomeController::class, 'gallery'])->name('gallery');

Route::get('/standard', [HomeController::class, 'standard'])->name('standard');
Route::get('/single-standard.html', [HomeController::class, 'standard'])->name('standard');

Route::get('/loginadmin', [HomeController::class, 'loginadmin'])->name('loginadmin');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */

require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';