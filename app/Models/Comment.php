<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Comment extends Model
{
    use HasFactory;

    // Привязка к таблицам (прописываем, как в миграциях)
    protected $table = 'comments';
    protected $guarded = false;


    public function user()
    {
        // Урок 37. Один ко многим
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Урок 37. Создание Атрибутов, что бы не расширять Carbon. Геттеры.
    // Что бы функцию вызвать напиши - dataAsCarbon (get и Atribute опускаем).
    public function getdataAsCarbonAttribute()
    {
        return Carbon::parse($this->created_at);
    }

}
