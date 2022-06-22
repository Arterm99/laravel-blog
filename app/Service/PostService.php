<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function store($data)
    {

        try {
            // Транзакции
            DB::beginTransaction();

            if (isset($data['tag_ids'])) {
                // Подключаем теги
                $tagIds = $data['tag_ids'];
                // Удаление
                unset($data['tag_ids']);
            }

            // Сохранение файлов в storage, disk сохраняет в папку 'public'
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            $post = Post::firstOrCreate($data); // Уникальные данные

            if (isset($tagIds)) {
                $post->tags()->attach($tagIds);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            // Прекращаем выполнение. 500 - ошибка на стороне сервера
            abort(500);
        }
    }

    public function update($data, $post)
    {

        try {
            // Транзакции
            DB::beginTransaction();

            if (isset($data['tag_ids'])) {
                // Подключаем теги
                $tagIds = $data['tag_ids'];
                // Удаление
                unset($data['tag_ids']);
            }

            // Сохранение файлов в storage, disk сохраняет в папку 'public'

            if (isset($data['preview_image'])) {
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }
            if (isset($data['main_image'])) {
                $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            }

            $post->update($data);

            if (isset($tagIds)) {
                // sync - удаляет старые привязки с тегами, и добавляет только те, которые мы указали
                $post->tags()->sync($tagIds);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            // Прекращаем выполнение. 500 - ошибка на стороне сервера
            abort(500);
        }
        return $post;

    }

}
