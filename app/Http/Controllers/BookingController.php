<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreBookingRequest;
use App\Models\Room;
use App\Models\Stay;
use App\Services\BookingService;

class BookingController extends Controller
{

    public function index()
    {
        $list = auth()->user()->bookings;
        return view('panel.booking.list', compact('list'));
    }

    public function store(StoreBookingRequest $request, Stay $stay, Room $room)
    {
        $data = $request->all();
        $data['stay'] = $stay;
        $data['room'] = $room;

        $bookingService = (new BookingService($room));

        if (!$bookingService->canBook($data['start_at'], $data['end_at'])) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Date conflict.'
            ]);
        }

        $bookingService->create($data);
        return redirect()->route('booking.index');
    }

}
