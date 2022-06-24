<?php

namespace App\Models;

use App\Notifications\SendVerifyWithQueueNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


// Создали имплементацию 28 урок и отправляем письмо с подтверждением регистрации на почту
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    // К Ролям в User
    const ROLE_ADMIN = 0;
    const ROLE_READER = 1;

    // Превращаем 0 и 1 в Админ, Читатель (мэппинг)
    public static function getRoles()
    {
        return [
            self::ROLE_ADMIN => 'Админ',
            self::ROLE_READER => 'Читатель',
        ];
    }

    /**
     * Атрибуты, которые можно массово присваивать.
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Атрибуты, которые должны быть приведены.
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Урок 29. ОЧереди
    public function sendEmailVerificationNotification()
    {

        // Подключаем созданный Notifications
        $this->notify(new SendVerifyWithQueueNotification());
    }

    // Урок 33. Получение лайков
    public function LikedPosts()
    {
        return $this->belongsToMany(Post::class, 'post_user_likes', 'user_id', 'post_id');
    }
    // Урок 34. Получение комментариев
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
}
