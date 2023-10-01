<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Status
    const PENDING = 'pending';
    const ACCEPTED = 'accepted';
    const REJECTED = 'rejected';

    protected $fillable = [
        'stay_id',
        'user_id',
        'parent_id',
        'status',
        'star',
        'content'
    ];


    public function author()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function stay()
    {
        return $this->hasOne(Stay::class,'id','stay_id');
    }
    public function parent()
    {
        return $this->hasOne(Comment::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeIsAccepted(Builder $query)
    {
        return $query->where('status', self::ACCEPTED);
    }

    public function scopeIsPending(Builder $query)
    {
        return $query->where('status', self::PENDING);
    }

}
