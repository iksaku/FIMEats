<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param string $name
     * @return void
     */
    public function show(string $name)
    {
        logger()->info('Looking for \''.$name.'\' Product...');

        /** @var Collection $products */
        $products = Product::where('name', 'LIKE', '%'.$name.'%')
            ->with(['cafeteria', 'categories'])
            ->get();

        if (empty($products) || $products->count() < 1) {
            logger()->info('Unable to find Product \''.$name.'\'...');

            return inertia()->render('Error', [
                'message' => 'Product \''.$name.'\' not found.',
            ]);
        }

        logger()->info('Found Product \''.$name.'\'... Displaying...');

        return inertia()->render('Product', compact('products'));
    }
}
