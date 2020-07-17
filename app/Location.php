<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //We want to define relationship between locations and sublocations
    //here we want to reference to sublocations
    public function sublocations()
    {
        //define relationship between locations and sublocations
        //one location has multiple sublocations
        //so we have to specify the name of sublocation model
        return $this->hasMany('App\Sublocation'); //this is one->many relationship
    }

}
