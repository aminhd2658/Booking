<?php

namespace App\Services;

use App\Events\BookingCreated;
use App\Interfaces\ModelInterface;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Database\Eloquent\Model;

class BookingService implements ModelInterface
{
    public function __construct(private Room $room)
    {
    }

    public function create(array $data)
    {
        $room = $data['room'];

        if (!$this->canBook($data['start_at'], $data['end_at'])) {
            abort(400);
        }

        $booking = $room->bookings()->create([
            'user_id' => auth()->id(),
            'count_adults' => $data['count_adults'],
            'count_children' => $data['count_children'],
            'start_at' => $data['start_at'],
            'end_at' => $data['end_at'],
            'status' => Booking::PENDING,
            //'children_ages' => $data['children_ages'],
            //'description' => $data['description'],
        ]);

        BookingCreated::dispatch($booking);

        return $booking;
    }

    public function update(Model $model, array $data)
    {
        return $model->update($data);
    }


    public function delete(Model $model)
    {
    }

    // Returns true if user selected dates isn't available because of booked or disabled
    public function canBook($startAt, $endAt)
    {
        $booking = $this->room->bookings()
            ->whereNotIn('status', [Booking::REJECTED])
            ->where(function ($q) use ($endAt, $startAt) {
                $q->whereBetween('start_at', [$startAt, $endAt])
                    ->orWhereBetween('end_at', [$startAt, $endAt]);
            })
            ->exists();

        $disableDays = $this->room->disabledDays()
            ->whereBetween('date', [$startAt, $endAt])
            ->exists();

        if ($booking || $disableDays) {
            return false;
        } else {
            return true;
        }
    }
}
