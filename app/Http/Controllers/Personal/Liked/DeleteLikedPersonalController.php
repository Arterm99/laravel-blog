<?php

namespace App\Http\Controllers\Personal\Liked;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class DeleteLikedPersonalController extends Controller
{
    public function __invoke(Post $post)
    {

        // Отсоединяем запрос, а не удаляем. LikedPosts() c круглыми скобками создаем запрос в базу, без скобок - это полученная коллекция
        auth()->user()->LikedPosts()->detach($post->id);
        return redirect()->route('personal.liked.index');
    }

}
