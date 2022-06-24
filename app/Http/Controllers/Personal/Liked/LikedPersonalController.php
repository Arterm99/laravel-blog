<?php

namespace App\Http\Controllers\Personal\Liked;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class LikedPersonalController extends Controller
{
    public function __invoke()
    {

        $posts = auth()->user()->LikedPosts;
        return view('personal.liked.index', compact('posts'));
    }

}
