<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    // Status
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';

    protected $fillable = [
        'name',
        'icon',
        'status'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
