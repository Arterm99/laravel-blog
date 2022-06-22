<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StoreUserController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        // Создаем пароль
        $data['password'] = Hash::make($data['password']);

        User::firstOrCreate(['email' => $data['email']], $data); // Уникальные данные, уникализируем email, что бы не было ошибок из БД
        return redirect()->route('admin.user.index');
    }

}
