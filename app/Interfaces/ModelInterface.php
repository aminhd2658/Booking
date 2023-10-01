<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ModelInterface
{
    public function create(array $data);

    public function update(Model $model, array $data);

    public function delete(Model $model);
}
