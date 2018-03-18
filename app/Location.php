<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name',
                          'latitude',
                          'longitude',
                          'address',
                          'category',
                          'link',
                          'rating',
                          'image'
    ];
}
