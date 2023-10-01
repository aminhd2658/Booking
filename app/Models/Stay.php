<?php

namespace App\Models;

use App\Traits\Featureable;
use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stay extends Model
{
    use HasFactory, Imageable, Featureable;

    // Status
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';

    protected $fillable = [
        'province_id',
        'name',
        'image',
        'address',
        'description',
        'map_lat',
        'map_lng',
        'status'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function province()
    {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getRatingAttribute()
    {
        return rand(1, 5);
        //return $this->comments()->isAccepted()->avg('star');
    }


    public function scopeIsActive(Builder $query)
    {
        return $query->where('status', self::ACTIVE);
    }

}
