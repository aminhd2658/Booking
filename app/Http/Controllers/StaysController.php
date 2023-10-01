<?php

namespace App\Http\Controllers;

use App\Models\Stay;

class StaysController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(Stay $stay)
    {
        return view('stays.single', compact('stay'))->with([
            'pageTitle' => $stay->name
        ]);
    }

}
