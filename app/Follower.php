<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = [
        'from_user_id', 'to_user_id', 'accepted'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function from_user()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function to_user()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }


}
