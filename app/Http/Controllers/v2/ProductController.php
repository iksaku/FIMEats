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

        /** @var Collection $product */
        $product = Product::where('name', 'LIKE', '%'.$name.'%')
            ->with(['cafeteria', 'categories'])
            ->get();

        if (empty($product)) {
            logger()->info('Unable to find Product \''.$name.'\'...');

            return response()->json([
                'message' => 'Product \''.$name.'\' not found.',
            ], 404);
        }

        logger()->info('Found Product \''.$name.'\'... Displaying...');

        return response()->json($product);
    }
}
