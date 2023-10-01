<?php

namespace App\Models;

use App\Traits\Featureable;
use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory, Imageable, Featureable;

    // Status
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';

    protected $fillable = [
        'stay_id',
        'name',
        'description',
        'count',
        'max_count_adults',
        'max_count_children',
        'price_per_night',
        'discount_price_per_night',
        'final_price_per_night'
    ];

    public function stay()
    {
        return $this->belongsTo(Stay::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function disabledDays()
    {
        return $this->hasMany(DisableDay::class);
    }

    public function getDiscountPercentAttribute()
    {
        if ($this->discount_price_per_night > 0) {
            return intval($this->discount_price_per_night / $this->final_price_per_night * 100);
        } else {
            return null;
        }
    }


}
