<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        'name',
        'status',
        'user_id'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }
}
