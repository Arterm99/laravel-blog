<?php

use App\Http\Controllers\Admin\Category\CreateCategoryController;
use App\Http\Controllers\Admin\Category\DeleteCategoryController;
use App\Http\Controllers\Admin\Category\EditCategoryController;
use App\Http\Controllers\Admin\Category\IndexCategoryController;
use App\Http\Controllers\Admin\Category\ShowCategoryController;
use App\Http\Controllers\Admin\Category\StoreCategoryController;
use App\Http\Controllers\Admin\Category\UpdateCategoryController;
use App\Http\Controllers\Admin\Main\IndexAdminController;
use App\Http\Controllers\Admin\Post\CreatePostController;
use App\Http\Controllers\Admin\Post\DeletePostController;
use App\Http\Controllers\Admin\Post\EditPostController;
use App\Http\Controllers\Admin\Post\IndexPostController;
use App\Http\Controllers\Admin\Post\ShowPostController;
use App\Http\Controllers\Admin\Post\StorePostController;
use App\Http\Controllers\Admin\Post\UpdatePostController;
use App\Http\Controllers\Admin\Tag\CreateTagController;
use App\Http\Controllers\Admin\Tag\DeleteTagController;
use App\Http\Controllers\Admin\Tag\EditTagController;
use App\Http\Controllers\Admin\Tag\IndexTagController;
use App\Http\Controllers\Admin\Tag\ShowTagController;
use App\Http\Controllers\Admin\Tag\StoreTagController;
use App\Http\Controllers\Admin\Tag\UpdateTagController;
use App\Http\Controllers\Admin\User\CreateUserController;
use App\Http\Controllers\Admin\User\DeleteUserController;
use App\Http\Controllers\Admin\User\EditUserController;
use App\Http\Controllers\Admin\User\IndexUserController;
use App\Http\Controllers\Admin\User\ShowUserController;
use App\Http\Controllers\Admin\User\StoreUserController;
use App\Http\Controllers\Admin\User\UpdateUserController;
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


// auth - проверяет, авторизован ли пользователь, далее проверка на "админство"
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified']], function() {
    Route::group(['namespace' => 'Main'], function () {
        Route::get('/', [IndexAdminController::class, '__invoke']);
    });

    Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
        Route::get('/', [IndexPostController::class, '__invoke'])->name('admin.post.index');
        Route::get('/create', [CreatePostController::class, '__invoke'])->name('admin.post.create');
        Route::post('/', [StorePostController::class, '__invoke'])->name('admin.post.store');
        Route::get('/{post}', [ShowPostController::class, '__invoke'])->name('admin.post.show');
        Route::get('/{post}/edit', [EditPostController::class, '__invoke'])->name('admin.post.edit');
        Route::patch('/{post}', [UpdatePostController::class, '__invoke'])->name('admin.post.update');
        Route::delete('/{post}', [DeletePostController::class, '__invoke'])->name('admin.post.delete');
    });

    Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function () {
        Route::get('/', [IndexCategoryController::class, '__invoke'])->name('admin.category.index');
        Route::get('/create', [CreateCategoryController::class, '__invoke'])->name('admin.category.create');
        Route::post('/', [StoreCategoryController::class, '__invoke'])->name('admin.category.store');
        Route::get('/{category}', [ShowCategoryController::class, '__invoke'])->name('admin.category.show');
        Route::get('/{category}/edit', [EditCategoryController::class, '__invoke'])->name('admin.category.edit');
        Route::patch('/{category}', [UpdateCategoryController::class, '__invoke'])->name('admin.category.update');
        Route::delete('/{category}', [DeleteCategoryController::class, '__invoke'])->name('admin.category.delete');
    });

    Route::group(['namespace' => 'Tag', 'prefix' => 'tags'], function () {
        Route::get('/', [IndexTagController::class, '__invoke'])->name('admin.tag.index');
        Route::get('/create', [CreateTagController::class, '__invoke'])->name('admin.tag.create');
        Route::post('/', [StoreTagController::class, '__invoke'])->name('admin.tag.store');
        Route::get('/{tag}', [ShowTagController::class, '__invoke'])->name('admin.tag.show');
        Route::get('/{tag}/edit', [EditTagController::class, '__invoke'])->name('admin.tag.edit');
        Route::patch('/{tag}', [UpdateTagController::class, '__invoke'])->name('admin.tag.update');
        Route::delete('/{tag}', [DeleteTagController::class, '__invoke'])->name('admin.tag.delete');
    });

    Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
        Route::get('/', [IndexUserController::class, '__invoke'])->name('admin.user.index');
        Route::get('/create', [CreateUserController::class, '__invoke'])->name('admin.user.create');
        Route::post('/', [StoreUserController::class, '__invoke'])->name('admin.user.store');
        Route::get('/{user}', [ShowUserController::class, '__invoke'])->name('admin.user.show');
        Route::get('/{user}/edit', [EditUserController::class, '__invoke'])->name('admin.user.edit');
        Route::patch('/{user}', [UpdateUserController::class, '__invoke'])->name('admin.user.update');
        Route::delete('/{user}', [DeleteUserController::class, '__invoke'])->name('admin.user.delete');
    });

});

// Создали имплементацию 28 урок и отправляем письмо с подтверждением регистрации на почту
Auth::routes(['verify' => true]);
