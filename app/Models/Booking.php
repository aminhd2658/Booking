<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Status
    const NOT_PAYED = 'not_payed';
    const PENDING = 'pending';
    const ACCEPTED = 'accepted';
    const REJECTED = 'rejected';

    protected $fillable = [
        'room_id',
        'user_id',
        'payment_id',
        'count_adults',
        'count_children',
        'children_ages',
        'start_at',
        'end_at',
        'status',
        'description'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'id', 'payment_id');
    }

    public function getPaymentAttribute()
    {
        return $this->payments()->isCompleted()->first();
    }

    public function room()
    {
        return $this->hasOne(Room::class, 'id', 'room_id');
    }

    public function scopeIsPending(Builder $query)
    {
        return $query->where('status', self::PENDING);
    }


}
