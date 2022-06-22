<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StoreUserController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        // Получение пароля из письма
        $password = Str::random(10);
        $data['password'] = Hash::make($password);

        /* Создаем просто пароль (старое)
        $data['password'] = Hash::make($data['password']);
        */

        $user = User::firstOrCreate(['email' => $data['email']], $data); // Уникальные данные, уникализируем email, что бы не было ошибок из БД

        // Отправляем письмо с паролем на указанный класс: PasswordMail
        Mail::to($data['email'])->send(new PasswordMail($password));

        // Регистрируем нового пользователя через хелпер event, отправляя письмо на почту, в Registered обязательно должна быть модель
        event(new Registered($user));

        return redirect()->route('admin.user.index');
    }

}
