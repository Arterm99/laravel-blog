<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexCategoryController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        // compact позволяет сделать доступными любые массивы, данные, аналогичен массиву: 'table' => $table
        return view('admin.category.index', compact( 'categories'));
    }

}
