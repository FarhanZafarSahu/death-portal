<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuilderController extends Controller
{
    public function create()
    {
        return view('builder')->with([
            // can provide a previously-saved form definition here
            'definition' => null,
        ]);
    }

    public function store(Request $request)
    {
        return response()->json($request['components'][0]);
    }
}
