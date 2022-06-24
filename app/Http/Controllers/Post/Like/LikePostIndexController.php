<?php

namespace App\Http\Controllers\Post\Like;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentPost\Comment\StoreRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class LikePostIndexController extends Controller
{
    public function __invoke(Post $post)
    {
        // Урок 38 toggle - если был уже выбран этот пост, то он отвяжет этот пост. С англ. Вкл/вкл
        auth()->user()->LikedPosts()->toggle($post->id);
        // redirect()->back() возвращает на страницу, с которой ушел
        return redirect()->back();
    }

}
