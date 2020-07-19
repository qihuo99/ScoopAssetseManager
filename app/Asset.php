<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{


    //We want to define relationship between Assets and brands
    //here we want to reference to brands
    public function brands()
    {
        //define relationship between Assets and brands
        //one asset has only one brand
        //so we have to specify the name of brand model
        return $this->hasMany('App\Brand'); //this is one->one relationship
    }


    //here we want to define relationship between locations and sublocations
    //here we want to reference to sublocations
    public function subcategories()
    {
        //define relationship between categories and subcategories
        //one location has multiple sublocations
        //so we have to specify the name of sublocation model
        return $this->hasMany('App\Subcategory'); //this is one->many relationship
    }

    //here we want to reference to sublocations
    public function sublocations()
    {
        //define relationship between Assets and sublocations
        //one asset has only one sublocation
        //so we have to specify the name of sublocation model
        return $this->hasOne('App\Sublocation'); //this is one->one relationship
    }

  /*
    //here we want to define relationship between assets and subcategories
    //here we want to reference to subcategories
    public function subcategories()
    {
        //define relationship between assets and subcategories
        //one asset has only one subcategory
        //so we have to specify the name of subcategory model
        return $this->hasOne('App\Subcategory'); //this is one->one relationship
    }  */

}
