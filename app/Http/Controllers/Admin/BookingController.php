<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $list = Booking::whereNotIn('status', [Booking::NOT_PAYED])->get();
        return view('panel.booking.list', compact('list'));
    }


    public function update(Request $request, Booking $booking)
    {
        (new BookingService($booking->room))->update($booking, $request->only('status'));
        return redirect()->back();
    }
}
