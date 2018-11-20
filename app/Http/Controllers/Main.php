<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Consumable;
use App\Models\Faculty;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class Main extends Controller
{
    /**
     * Website's Main page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $faculties = Faculty::query()->orderByRaw('short_name = "FIME" desc, short_name asc')->get();
        return view('index', compact('faculties'));
    }

    /**
     * Renders Faculty page while listing its Cafeterias
     * and available Consumables
     *
     * @param string $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function faculty(string $name) {
        $faculty = Faculty::whereShortName($name)->first();

        if (empty($faculty)) return abort(404);

        return view('faculty', compact('faculty'));
    }

    /**
     * Renders Category page while showing Consumables in that Category,
     * which are grouped by Cafeteria
     *
     * @param string $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category(string $name) {
        $category = Category::whereName($name)->first();

        if(empty($category)) return abort(404);

        return view('category', compact('category'));
    }

    /**
     * Renders a page which lists similarly named Consumables,
     * along with the Cafeteria it's owned at and the Price
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function compare(Request $request) {
        $name = $request->input('name');
        if (empty($name)) return abort(404);

        /** @var Collection $consumables */
        $consumables = Consumable::query()->where('name', 'LIKE', '%' . str_replace(' ', '%', $name) . '%')->get();

        return view('compare', compact('consumables', 'name'));
    }
}
