<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;

class ShowPostIndexController extends Controller
{
    public function __invoke(Post $post)
    {

        // Дата
        $data = Carbon::parse($post->created_at);

        // Похожие Посты, Релайтед Пост
        // Что бы достать удаленный посат воспользуйся  withTrashed()
        $relatedPosts = Post::withTrashed()->where('category_id', $post->category_id)

            // убираем одинаковые посты
            ->where('id', '!=', $post->id)

            ->get()
            ->take(4);

        // (ошибка) Что бы вернуть удаленный пост в базу напиши: $relatedPosts->restore();

        return view('post.show', compact('post', 'data', 'relatedPosts'));
    }

}
