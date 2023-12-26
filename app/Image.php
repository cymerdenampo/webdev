<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }

}
