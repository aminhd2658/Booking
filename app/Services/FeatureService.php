<?php

namespace App\Services;

use App\Interfaces\ModelInterface;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class FeatureService implements ModelInterface
{
    public function create(array $data)
    {
        $data = $this->prepareData($data);
        return Feature::create($data);
    }

    public function update($room, array $data)
    {
        $data = $this->prepareData($data);
        return $room->update($data);
    }

    public function delete(Model $model)
    {
        return $model->delete();
    }

    private function prepareData(array $data)
    {
        if (isset($data['icon']) and $data['icon'] instanceof File) {
            $icon = Storage::disk('public')->putFile('features', $data['icon']);
            $data['icon'] = $icon;
        } else {
            unset($data['icon']);
        }
        return $data;
    }
}
