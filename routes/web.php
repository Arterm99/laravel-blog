<?php

use App\Http\Controllers\Admin\Category\CreateCategoryController;
use App\Http\Controllers\Admin\Category\EditCategoryController;
use App\Http\Controllers\Admin\Category\IndexCategoryController;
use App\Http\Controllers\Admin\Category\ShowCategoryController;
use App\Http\Controllers\Admin\Category\StoreCategoryController;
use App\Http\Controllers\Admin\Category\UpdateCategoryController;
use App\Http\Controllers\Admin\Main\IndexAdminController;
use App\Http\Controllers\Main\IndexController;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Main'], function () {
    Route::get('/', [IndexController::class, '__invoke']);
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::group(['namespace' => 'Main'], function () {
        Route::get('/', [IndexAdminController::class, '__invoke']);
    });

    Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function () {
        Route::get('/', [IndexCategoryController::class, '__invoke'])->name('admin.category.index');
        Route::get('/create', [CreateCategoryController::class, '__invoke'])->name('admin.category.create');
        Route::post('/', [StoreCategoryController::class, '__invoke'])->name('admin.category.store');
        Route::get('/{category}', [ShowCategoryController::class, '__invoke'])->name('admin.category.show');
        Route::get('/{category}/edit', [EditCategoryController::class, '__invoke'])->name('admin.category.edit');
        Route::patch('/{category}', [UpdateCategoryController::class, '__invoke'])->name('admin.category.update');
    });

});


Auth::routes();
