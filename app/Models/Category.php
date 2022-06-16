<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Привязка к таблицам (прописываем, как в миграциях)
    protected $table = 'categories';
    protected $guarded = false;
}
