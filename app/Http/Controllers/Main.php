<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Faculty;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class Main extends Controller
{
    public function index() {
        $faculties = Faculty::query()->orderByRaw('short_name = "FIME" desc, short_name asc')->get();
        return view('index', compact('faculties'));
    }

    public function faculty(string $name) {
        $faculty = Faculty::whereShortName($name)->first();

        if (empty($faculty)) return abort(404);

        return view('faculty', compact('faculty'));
    }

    public function category(string $name) {
        $category = Category::whereName($name)->first();

        if(empty($category)) return abort(404);

        // TODO

        return redirect(route('index'));
    }

    public function consumable(string $name) {
        $consumables = Category::query()->where('name', 'LIKE', str_replace(' ', '%', $name));

        if (empty($consumables)) return abort(404);

        // TODO

        return redirect(route('index'));
    }
}
