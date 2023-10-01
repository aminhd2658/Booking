<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisableDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'date'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}
