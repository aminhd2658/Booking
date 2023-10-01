<?php

namespace App\Services;

use App\Interfaces\ModelInterface;
use App\Models\Stay;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\Storage;

class StayService implements ModelInterface
{

    public function create(array $data)
    {
        $data = $this->prepareData($data);

        $stay = Stay::create($data);

        if (isset($data['features']))
            $stay->features()->syncWithPivotValues($data['features'], ['featureable_type' => Stay::class]);

        return $stay;
    }

    public function update($stay, array $data)
    {
        $data = $this->prepareData($data);

        if (isset($data['features']))
            $stay->features()->syncWithPivotValues($data['features'], ['featureable_type' => Stay::class]);

        return $stay->update($data);
    }

    public function delete(Model $model)
    {
        return $model->delete();
    }

    private function prepareData(array $data)
    {
        $data['province_id'] = $data['province'];
        $data['status'] = Stay::ACTIVE;

        if (isset($data['image']) and $data['image'] instanceof File) {
            $image = Storage::disk('public')->putFile('stays', $data['image']);
            $data['image'] = $image;
        } else {
            unset($data['image']);
        }


        return $data;
    }
}
