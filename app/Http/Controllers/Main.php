<?php

namespace App\Http\Controllers;

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
}
