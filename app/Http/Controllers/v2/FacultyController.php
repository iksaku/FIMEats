<?php

namespace App\Http\Controllers\v2;

use App\Faculty;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        logger()->info('Showing list of Faculties...');

        return response()->json(Faculty::all());
    }

    /**
     * Display the specified resource.
     *
     * @param string $name
     * @return Response
     */
    public function show(string $name)
    {
        logger()->info('Looking for \''.$name.'\' Faculty...');

        /** @var Faculty $faculty */
        $faculty = Faculty::where('name', $name)
            ->orWhere('short_name', $name)
            ->with('cafeterias.products.categories')
            ->first();

        if (empty($faculty)) {
            logger()->info('Unable to find Faculty \''.$name.'\'...');

            return response()->json([
                'message' => 'Faculty \''.$name.'\' not found.',
            ], 404);
        }

        logger()->info('Found Faculty \''.$faculty->name.'\'... Displaying...');

        return response()->json($faculty);
    }
}
