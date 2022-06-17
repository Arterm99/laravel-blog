<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    // Удаление
    use SoftDeletes;

    // Привязка к таблицам (прописываем, как в миграциях)
    protected $table = 'categories';
    protected $guarded = false;
}
