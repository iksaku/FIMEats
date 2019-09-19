<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param string $name
     * @return void
     */
    public function show(Request $request, string $name)
    {
        logger()->info('Looking for \''.$name.'\' Product...');

        $ref = $request->get('ref');

        /** @var Collection $products */
        $products = Product::where('name', 'LIKE', '%'.$name.'%')
            ->with(['cafeteria.faculty', 'categories'])
            ->when(!empty($ref) && is_numeric($ref), function (Builder $query) use ($ref) {
                $query->orderByRaw('id = '.(int) $ref.' desc');
            })
            ->get();

        if (empty($products) || $products->count() < 1) {
            logger()->info('Unable to find Product \''.$name.'\'...');

            return inertia()->render('Error', [
                'message' => 'Oops, no encontramos el Producto \''.$name.'\'.',
            ]);
        }

        logger()->info('Found Product \''.$name.'\'... Displaying...');

        return inertia()->render('Product', compact('name', 'products'));
    }
}
