<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class IndexTagController extends Controller
{
    public function __invoke()
    {
        $tags = Tag::all();
        // compact позволяет сделать доступными любые массивы, данные, аналогичен массиву: 'table' => $table
        return view('admin.tag.index', compact( 'tags'));
    }

}
