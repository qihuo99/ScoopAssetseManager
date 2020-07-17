<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sublocation extends Model
{
    //$fillable means only the field names inside the array can be mass-assign
    //$guarded specifies which fields are not mass assignable.
    //protected $guarded = [];

    //If you want to block all fields from being mass-assign you can just do this.
    //protected $guarded = [‘*’];
    public function location()
    {
        //define relationship between locations and sublocations
        //each sublocation belongs to only one location
        //so we have to specify the name of Location model
        return $this->belongsTo('App\Location'); //this is one->many relationship
    }
    
}
