<?php

namespace App\Http\Controllers\Post\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentPost\Comment\StoreRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class CommentPostIndexController extends Controller
{
    public function __invoke(StoreRequest $storeRequest, Post $post)
    {
        $data = $storeRequest->validated();

        $data['user_id'] = auth()->user()->id;
        $data['post_id'] = $post->id;

        Comment::create($data);
        return redirect()->route('post.show', $post->id);
    }

}
