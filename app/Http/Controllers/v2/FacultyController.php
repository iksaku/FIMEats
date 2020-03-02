<?php

namespace App\Http\Controllers\v2;

use App\Faculty;
use App\Http\Controllers\Controller;

class FacultyController extends Controller
{
    /*
     * Display the specified resource.
     */
    public function show(Faculty $faculty)
    {
        $faculty->load('cafeterias.products');

        return view('faculty', compact('faculty'));
    }
}
