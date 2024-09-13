<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAjaxController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\DeveloperController;
use App\Http\Controllers\Admin\AdminAreasController;
use App\Http\Controllers\Admin\AdminAuthorController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminLandmarksController;
use App\Http\Controllers\Admin\AdminStaticPageController;
use App\Http\Controllers\Admin\AdminMunicipalitiesController;
use App\Http\Controllers\Admin\AdminParliamentaryGroupController;

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);

    /* Developer Menu */
    Route::get('/developer/menu/index', [DeveloperController::class, 'menuIndex'])->name('developer.menu.index');
    Route::post('/developer/menu/index', [DeveloperController::class, 'menuStore'])->name('developer.menu.store');
    Route::post('/developer/menu/sortorder', [MenuController::class, 'updateMenuOrder'])->name('developer.menu.updateMenu');

    /* Categories */
    Route::get('/categories/index/{parentId?}', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create/{parentId?}', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store/{parentId?}', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{id}', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/update/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/destroy/{id}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

    /* Books */
    Route::resource('news', AdminNewsController::class)->except(['show', 'update']);
    Route::put('news/{id}', [AdminNewsController::class, 'update'])->name('news.update');

    /* Pages */
    Route::resource('pages', AdminStaticPageController::class)->except(['show', 'update']);
    Route::put('pages/{id}', [AdminStaticPageController::class, 'update'])->name('pages.update');

    /* Authors */
    Route::resource('authors', AdminAuthorController::class)->except(['show'])->except(['update']);
    Route::put('authors/{id}', [AdminAuthorController::class, 'update'])->name('authors.update');

    /* Landmarks */
    Route::resource('landmarks', AdminLandmarksController::class)->except(['show', 'update']);
    Route::put('landmarks/{id}', [AdminLandmarksController::class, 'update'])->name('landmarks.update');
    
    /* Municipalities */
    Route::resource('municipalities', AdminMunicipalitiesController::class)->except(['show', 'update']);
    Route::put('municipalities/{id}', [AdminMunicipalitiesController::class, 'update'])->name('municipalities.update');
    
    /* Paliamentary Group */
    Route::resource('parties', AdminParliamentaryGroupController::class)->except(['show', 'update']);
    Route::put('parties/{id}', [AdminParliamentaryGroupController::class, 'update'])->name('parties.update');

    /* Areas */
    Route::resource('areas', AdminAreasController::class)->except(['show', 'update']);
    Route::put('areas/{id}', [AdminAreasController::class, 'update'])->name('areas.update');

    /* AJAX REQUESTS */
    Route::any('/ajax/uploadImageTinymce', [AdminAjaxController::class, 'uploadImageTinymceORIGINAL']);
    Route::post('/ajax/uploadGalleryImage', [AdminAjaxController::class, 'uploadGalleryImage']);

    Route::get('/news/ajax/search/{word?}', [AdminAjaxController::class, 'searchNews']);

    /*
     * SUPER ADMIN URLs
     */
    /* Developer Tree */
    Route::get('/developer/tree/index', [DeveloperController::class, 'treeIndex'])->name('developer.tree.index');
});