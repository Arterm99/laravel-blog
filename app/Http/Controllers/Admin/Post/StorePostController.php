<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class StorePostController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        // Транзакции
        try {
        $data = $request->validated();

        // Подключаем теги
        $tagIds = $data['tag_ids'];
        // Удаление
        unset($data['tag_ids']);

        // Сохранени файлов
        $data['preview_image'] = Storage::put('images', $data['preview_image']);
        $data['main_image'] = Storage::put('images', $data['main_image']);
        $post = Post::firstOrCreate($data); // Уникальные данные
        $post->tags()->attach($tagIds);

        } catch (\Exception $exception) {
            // Прекращаем выполнение
            abort(404);
        }

        return redirect()->route('admin.post.index');
    }

}
