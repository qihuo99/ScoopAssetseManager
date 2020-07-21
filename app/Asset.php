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
        //In addition, Eloquent assumes that the foreign key has a value matching the id 
        // (or the custom $primaryKey) column of the parent. 
        //return $this->hasOne('App\Phone', 'foreign_key', 'local_key'); -> sample code
        return $this->hasOne('App\Brand'); 
    }

    //here we want to define relationship between locations and subcategories
    //here we want to reference to subcategories
    public function subcategories()
    {
        //define relationship between assets and subcategories
        //one asset has only category-subcategory
        //so we have to specify the name of subcategory model
        //return $this->hasOne('App\Subcategory', 'subcategory_id', 'id'); 
        return $this->belongsTo('App\Subcategory'); 
    }

    //here we want to reference to sublocations
    public function sublocations()
    {
        //define relationship between Assets and Sublocations
        //one asset has only one location-sublocation
        //so we have to specify the name of sublocation model
        return $this->hasOne('App\Sublocation'); 
    }

}
