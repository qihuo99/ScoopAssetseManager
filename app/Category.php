<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //here we want to define relationship between locations and sublocations
    //here we want to reference to sublocations
    public function subcategories()
    {
        //define relationship between categories and subcategories
        //one location has multiple sublocations
        //so we have to specify the name of sublocation model
        return $this->hasMany('App\Subcategory'); //this is one->many relationship
    }

}
