<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    // Привязка к таблицам (прописываем, как в миграциях)
    protected $table = 'posts';
    protected $guarded = false;

    // Урок 38 Для посчёта лайков. Считаем отношения
    protected $withCount = ['LikedUsers'];

    // Урок 39 Оптимизация. Telescope. Прописываем в скобках оношения, указанные ниже для оптимизации запросов к странице
    // Таким образом посты будут приходить сразу с категориями
    protected $with = ['category'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // отношение постов с лайками
    public function LikedUsers()
    {
        return $this->belongsToMany(User::class, 'post_user_likes', 'post_id', 'user_id');
    }

    // отношение постов с комментариями
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}
