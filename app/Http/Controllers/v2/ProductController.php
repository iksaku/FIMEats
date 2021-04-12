<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /*
     * Compare prices between similar products.
     */
    public function compare(Request $request, string $name): View
    {
        $validatedData = $request->validate([
            'ref' => 'sometimes|required|numeric',
        ]);

        $ref = $validatedData['ref'] ?? null;

        /** @var Collection $products */
        $products = Product::where('name', 'LIKE', '%'.$name.'%')
            ->with(['cafeteria.faculty', 'categories'])
            ->when(isset($ref), function (Builder $query) use ($ref) {
                $query->orderByRaw('id = '.$ref.' desc');
            })
            ->get();

        if ($products->count() < 1) {
            abort(404, 'Oops, no encontramos el productos similares a \''.$name.'\'.');
        }

        return view('product', compact('products', 'ref'));
    }
}
