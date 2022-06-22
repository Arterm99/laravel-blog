<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class ShowPostController extends BasePostController
{
    public function __invoke(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }

}
