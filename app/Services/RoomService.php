<?php

namespace App\Services;

use App\Interfaces\ModelInterface;
use App\Models\Room;
use App\Models\Stay;
use Illuminate\Database\Eloquent\Model;

class RoomService implements ModelInterface
{

    public function __construct(private Stay $stay)
    {
    }

    public function create(array $data)
    {
        $data = $this->prepareData($data);

        $room = $this->stay->rooms()->create($data);

        if (isset($data['features']))
            $room->features()->syncWithPivotValues($data['features'], ['featureable_type' => Room::class]);

        return $room;
    }

    public function update($room, array $data)
    {
        $data = $this->prepareData($data);

        if (isset($data['features']))
            $room->features()->syncWithPivotValues($data['features'], ['featureable_type' => Room::class]);

        return $room->update($data);
    }

    public function delete(Model $model)
    {
        return $model->delete();
    }


    // Remove discount key from data if is not gt 0 and calculate final_price_per_night
    private function prepareData(array $data)
    {
        if ($data['discount_price_per_night'] > 0) {
            $data['final_price_per_night'] = $data['price_per_night'] - $data['discount_price_per_night'];
        } else {
            unset($data['discount_price_per_night']);
            $data['final_price_per_night'] = $data['price_per_night'];
        }
        return $data;
    }
}
