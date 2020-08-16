<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['user_id', 'title', 'description'];

    public function scopeUnnotified($query)
    {
        return $query->where('notified', '=', false);
    }
}