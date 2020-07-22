<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //protected $fillable = ['asset','note','brand_id','sublocation_id','subcategory_id'];
    //$fillable means only the field names inside the array can be mass-assign
    //$guarded specifies which fields are not mass assignable.
    //protected $guarded = [];

    //If you want to block all fields from being mass-assign you can just do this.
    //protected $guarded = [‘*’];

    public function assets()
    {
        //define relationship between assets and brands
        //each brand belongs to only one asset
        //this is a one-to-many relationship
        //so we have to specify the name of Asset model
   //     return $this->belongsTo('App\Asset'); 
        return $this->hasOne('App\Brand'); 
   }

}
