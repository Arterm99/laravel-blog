<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class IndexUserController extends Controller
{
    public function __invoke()
    {
        $users = User::all();
        // compact позволяет сделать доступными любые массивы, данные, аналогичен массиву: 'table' => $table
        return view('admin.user.index', compact( 'users'));
    }

}
