<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostIndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::paginate(3);

        // get - обращение к колекциямm после метода get всегда на выходе получается коллекция
        $randomPosts = Post::get()->random(4);

        // лайки
        $likedPosts = Post::withCount('LikedUsers')->orderBy('liked_users_count', 'desc')->get()->take(4);
        return view('post.index', compact('posts', 'randomPosts', 'likedPosts'));
    }

}
