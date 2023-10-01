<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'gateway',
        'ref_num',
        'price',
        'status',
        'date'
    ];

    const CANCEL = 'cancel';
    const INCOMPLETE = 'incomplete';
    const COMPLETE = 'complete';


    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function scopeIsCompleted(Builder $query)
    {
        return $query->where('status', self::COMPLETE);
    }


}
