<?php

namespace App\Http\Controllers\v2;

use App\Faculty;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Inertia\Response as InertiaResponse;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        logger()->info('Redirecting back to home for list of Faculties...');

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param string $name
     * @return InertiaResponse
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

            return inertia()->render('Error', [
                'message' => 'Faculty \''.$name.'\' not found.',
            ]);
        }

        logger()->info('Found Faculty \''.$faculty->name.'\'... Displaying...');

        return inertia()->render('Faculty', $faculty->toArray());
    }
}
