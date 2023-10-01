<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DisableDay;
use App\Models\Room;
use App\Services\DisableDayService;
use Illuminate\Http\Request;

class DisableDaysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Room $room)
    {
        $list = $room->disabledDays;
        return view('panel.admin.stays.rooms.disabledDays.list', compact('list', 'room'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Room $room)
    {
        return view('panel.admin.stays.rooms.disabledDays.create', compact('room'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Room $room)
    {
        $data = $request->only('date');

        $disableRoomService = (new DisableDayService($room));

        if (!$disableRoomService->canDisable($data['date'])) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Date already booked.'
            ]);
        }

        $disableRoomService->create($data);

        return redirect()->back()->with([
            'status' => 'successfully',
            'message' => 'Successfully created.',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room, DisableDay $disableDay)
    {
        (new DisableDayService($room))->delete($disableDay);

        return redirect()->back()->with([
            'status' => 'successfully',
            'message' => 'Successfully deleted.',
        ]);

    }
}
