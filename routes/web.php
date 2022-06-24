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
use App\Http\Controllers\Category\CategoryIndexController;
use App\Http\Controllers\Category\Post\PostCategoryIndexController;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Personal\Comment\CommentPersonalController;
use App\Http\Controllers\Personal\Comment\DeleteCommentPersonalController;
use App\Http\Controllers\Personal\Comment\EditCommentPersonalController;
use App\Http\Controllers\Personal\Comment\UpdateCommentPersonalController;
use App\Http\Controllers\Personal\Liked\DeleteLikedPersonalController;
use App\Http\Controllers\Personal\Liked\LikedPersonalController;
use App\Http\Controllers\Personal\Main\IndexPersonalController;
use App\Http\Controllers\Post\Comment\CommentPostIndexController;
use App\Http\Controllers\Post\Like\LikePostIndexController;
use App\Http\Controllers\Post\PostIndexController;
use App\Http\Controllers\Post\ShowPostIndexController;
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


// MAin
Route::group(['namespace' => 'Main'], function () {
    Route::get('/', [IndexController::class, '__invoke'])->name('main.index');
});

// guest
Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
    Route::get('/', [PostIndexController::class, '__invoke'])->name('post.index');
    Route::get('/{post}', [ShowPostIndexController::class, '__invoke'])->name('post.show');


    // Способ с отображением комментариев
    // post/10/comments
    Route::group(['nemespace' => 'Comment', 'prefix' => '{post}/comments'], function () {
        Route::post('/', [CommentPostIndexController::class, '__invoke'])->name('post.comment.store');
    });
    Route::group(['nemespace' => 'Like', 'prefix' => '{post}/likes'], function () {
        Route::post('/', [LikePostIndexController::class, '__invoke'])->name('post.like.store');
    });
});

// Отображение категорий
Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function () {
    Route::get('/', [CategoryIndexController::class, '__invoke'])->name('category.index');

    Route::group(['nemespace' => 'Post', 'prefix' => '{category}/posts'], function () {
        Route::get('/', [PostCategoryIndexController::class, '__invoke'])->name('category.post.index');
    });
});


// personal
Route::group(['namespace' => 'Personal', 'prefix' => 'personal', 'middleware' => ['auth', 'verified']], function() {
    Route::group(['namespace' => 'Main', 'prefix' => 'main'], function () {
        Route::get('/', [IndexPersonalController::class, '__invoke'])->name('personal.main.index');
    });
    Route::group(['namespace' => 'Liked', 'prefix' => 'likeds'], function () {
        Route::get('/', [LikedPersonalController::class, '__invoke'])->name('personal.liked.index');
        Route::delete('/{post}', [DeleteLikedPersonalController::class, '__invoke'])->name('personal.liked.delete');
    });
    Route::group(['namespace' => 'Comment', 'prefix' => 'comments'], function () {
        Route::get('/', [CommentPersonalController::class, '__invoke'])->name('personal.comment.index');
        Route::get('/{comment}/edit', [EditCommentPersonalController::class, '__invoke'])->name('personal.comment.edit');
        Route::patch('/{comment}', [UpdateCommentPersonalController::class, '__invoke'])->name('personal.comment.update');
        Route::delete('/{comment}', [DeleteCommentPersonalController::class, '__invoke'])->name('personal.comment.delete');
    });
});


// admin
// auth - проверяет, авторизован ли пользователь, далее проверка на "админство"
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified']], function() {
    Route::group(['namespace' => 'Main'], function () {
        Route::get('/', [IndexAdminController::class, '__invoke'])->name('admin.main.index');
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
