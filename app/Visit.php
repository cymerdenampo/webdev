<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $guarded = [];

    
    public function visitor()
    {
        return $this->hasOne(User::class, 'id', 'visitor_id');
    }

}
