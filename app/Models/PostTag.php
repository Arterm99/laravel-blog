<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;

    // Привязка к таблицам (прописываем, как в миграциях)
    protected $table = 'post_tags';
    protected $guarded = false;
}
