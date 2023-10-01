<?php

namespace App\Traits;

use App\Models\Feature;

trait Featureable
{
    public function features()
    {
        return $this->morphToMany(Feature::class, 'featureable');
    }
}
