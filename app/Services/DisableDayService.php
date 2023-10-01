<?php

namespace App\Services;

use App\Interfaces\ModelInterface;
use App\Models\Room;
use Illuminate\Database\Eloquent\Model;

class DisableDayService implements ModelInterface
{

    public function __construct(private Room $room)
    {
    }

    public function create(array $data)
    {
        if (!$this->canDisable($data['date'])) {
            abort(400);
        }
        return $this->room->disabledDays()->firstOrCreate($data);
    }

    public function update($room, array $data)
    {
    }

    public function delete(Model $model)
    {
        return $model->delete();
    }


    // Return true if date isn't booked
    public function canDisable($date)
    {
        return !$this->room->bookings()->where('start_at', '<=', $date)
            ->where('end_at', '>=', $date)
            ->exists();
    }


}
