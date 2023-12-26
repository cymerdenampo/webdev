<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    protected $fillable = [
        'first_name', 'company', 'phone', 'email'
    ];
}
