<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Services\FeatureService;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Feature::get();
        return view('panel.admin.stays.features.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.admin.stays.features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        (new FeatureService())->create($request->all());

        return redirect()->back()->with([
            'status' => 'successfully',
            'message' => 'Successfully created.',
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        return view('panel.admin.stays.features.create', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        (new FeatureService())->update($feature, $request->all());

        return redirect()->back()->with([
            'status' => 'successfully',
            'message' => 'Successfully updated.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        (new FeatureService())->delete($feature);

        return redirect()->back()->with([
            'status' => 'successfully',
            'message' => 'Successfully deleted.',
        ]);
    }
}
