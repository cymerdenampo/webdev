<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

class Property extends Model
{
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(Image::class, 'property_id', 'id');
    }

    public function main_image()
    {
        // Retrieve a random image associated with the property
        return $this->hasOne(Image::class, 'property_id', 'id')->inRandomOrder()->first();
    }

    public function created_by()
    {
        return $this->hasOne(User::class, 'id', 'created_by_user_id');
    }

    public function feature_payments()
    {
        return $this->hasmany(FeaturePayment::class, 'id', 'property_id');
    }
}
