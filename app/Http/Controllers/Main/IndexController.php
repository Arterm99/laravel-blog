<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        // Делам редирект, так как Главное страницы пока нет
        return redirect()->route('post.index');
    }

}
