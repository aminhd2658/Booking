<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Room;
use App\Models\Stay;
use App\Services\RoomService;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Stay $stay)
    {
        $list = $stay->rooms;
        return view('panel.admin.stays.rooms.list', compact('list', 'stay'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Stay $stay)
    {
        $features = Feature::all();
        return view('panel.admin.stays.rooms.create', compact('stay', 'features'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Stay $stay)
    {
        (new RoomService($stay))->create($request->all());

        return redirect()->back()->with([
            'status' => 'successfully',
            'message' => 'Successfully created.',
        ]);

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stay $stay, Room $room)
    {
        $features = Feature::all();
        $currentFeatures = $room->features()->get()->pluck('id')->toArray();
        return view('panel.admin.stays.rooms.create', compact('room', 'stay', 'features', 'currentFeatures'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stay $stay, Room $room)
    {
        (new RoomService($stay))->update($room, $request->all());

        return redirect()->back()->with([
            'status' => 'successfully',
            'message' => 'Successfully updated.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stay $stay, Room $room)
    {
        (new RoomService($stay))->delete($room);

        return redirect()->back()->with([
            'status' => 'successfully',
            'message' => 'Successfully deleted.',
        ]);

    }
}
