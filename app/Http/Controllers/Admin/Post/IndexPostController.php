<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexPostController extends Controller
{
    public function __invoke()
    {
        $posts = Post::all();
        // compact позволяет сделать доступными любые массивы, данные, аналогичен массиву: 'table' => $table
        return view('admin.post.index', compact( 'posts'));
    }

}
