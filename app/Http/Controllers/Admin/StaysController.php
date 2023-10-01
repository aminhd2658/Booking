<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Province;
use App\Models\Stay;
use App\Services\StayService;
use Illuminate\Http\Request;

class StaysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Stay::latest()->get();
        return view('panel.admin.stays.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        $provinces = Province::all();
        $features = Feature::all();
        return view('panel.admin.stays.create', compact('countries', 'provinces', 'features'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        (new StayService())->create($request->all());

        return redirect()->back()->with([
            'status' => 'successfully',
            'message' => 'Successfully created.',
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stay $stay)
    {
        $countries = Country::all();
        $provinces = Province::all();
        $features = Feature::all();
        $currentFeatures = $stay->features()->get()->pluck('id')->toArray();
        return view('panel.admin.stays.edit', compact('stay', 'countries', 'provinces', 'features', 'currentFeatures'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stay $stay)
    {
        (new StayService())->update($stay, $request->all());

        return redirect()->back()->with([
            'status' => 'successfully',
            'message' => 'Successfully edited.',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stay $stay)
    {
        (new StayService())->delete($stay);

        return redirect()->back()->with([
            'status' => 'successfully',
            'message' => 'Successfully deleted.',
        ]);
    }
}
