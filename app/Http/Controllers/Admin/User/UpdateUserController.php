<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\USer\UpdateRequest;
use App\Models\USer;

class UpdateUserController extends Controller
{
    public function __invoke(UpdateRequest $request, USer $user)
    {
        $data = $request->validated();
        $user->update($data);
        return redirect()->route('admin.user.show', compact('user'));
    }

}
