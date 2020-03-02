<?php

namespace App\Http\Controllers\v2;

use App\Faculty;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    /*
     * Display a list of Faculties.
     */
    public function index(): View
    {
        $faculties = Faculty::orderByRaw('short_name = "FIME" desc, short_name asc')
            ->get();

        return view('home', compact('faculties'));
    }
}
