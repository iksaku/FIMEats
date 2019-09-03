<?php

namespace App\Http\Controllers\v2;

use App\Category;
use App\Http\Controllers\Controller;
use Inertia\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        logger()->info('Showing list of Categories...');

        $categories = Category::all()->pluck('name');

        return inertia()->render('Category/Index', compact('categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param string $name
     * @return Response
     */
    public function show(string $name)
    {
        logger()->info('Looking for \''.$name.'\' Category...');

        /** @var Category $category */
        $category = Category::whereName($name)
            ->with('products.cafeteria')
            ->first();

        if (empty($category)) {
            logger()->info('Unable to find Category \''.$name.'\'...');

            return inertia()->render('Error', [
                'message' => 'Category \''.$name.'\' not found.',
            ]);
        }

        logger()->info('Found Category \''.$category->name.'\'... Displaying...');

        return inertia()->render('Category/Show', $category->toArray());
    }
}
