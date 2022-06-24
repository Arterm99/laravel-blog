<?php

namespace App\Http\Controllers\Personal\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class DeleteCommentPersonalController extends Controller
{
    public function __invoke(Comment $comment)
    {
        // Удаление комментария
        $comment->delete();
        return redirect()->route('personal.comment.index');
    }

}
