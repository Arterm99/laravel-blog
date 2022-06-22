<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;

class UpdatePostController extends BasePostController
{
    public function __invoke(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();

        // Service
        // Взаимодействие с базой
        // Что бы вернуть обновленный через сервис пост, просто создаем переменную $post, а в Service ее возвращаем return-ом
        $post = $this->service->update($data, $post);

        return view('admin.post.show', compact('post'));
    }

}
