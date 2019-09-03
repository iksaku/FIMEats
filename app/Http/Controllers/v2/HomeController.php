<?php

namespace App\Http\Controllers\v2;

use App\Faculty;
use App\Http\Controllers\Controller;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Display a list of Faculties.
     *
     * @return Response
     */
    public function index()
    {
        logger()->info('Showing list of Faculties...');

        $faculties = Faculty::orderByRaw('short_name = "FIME" desc, short_name asc')->get();

        return inertia()->render('Home', compact('faculties'));
    }
}
