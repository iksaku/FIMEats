<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /*
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Category::all()->pluck('name');

        return view('category.index', compact('categories'));
    }

    /*
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        return view('category.show', compact('category'));
    }
}
