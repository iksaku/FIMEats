<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class ProductController extends Controller
{
    /*
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        /** @var Collection $products */
        $products = Product::where('name', 'LIKE', '%'.$product->name.'%')
            ->orderByRaw('id = '.$product->id.' desc')
            ->with(['cafeteria.faculty', 'categories'])
            /*->when(!empty($ref) && is_numeric($ref), function (Builder $query) use ($ref) {
                $query->orderByRaw('id = '.(int) $ref.' desc');
            })*/
            ->get();

        if ($products->count() < 1) {
            abort(404, 'Oops, no encontramos el productos similares a \''.$product->name.'\'.');
        }

        return view('product', compact('products'));
    }
}
