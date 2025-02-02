<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    //$fillable means only the field names inside the array can be mass-assign
    //$guarded specifies which fields are not mass assignable.
    //protected $guarded = [];
    protected $fillable = ['category_id','subcategory','note'];

    //If you want to block all fields from being mass-assign you can just do this.
    //protected $guarded = [‘*’];

    public function category()
    {
        //define relationship between categories and subcategories
        //each subcategory belongs to only one category
        //this is a one-to-many relationship
        //so we have to specify the name of Category model
        return $this->belongsTo('App\Category'); 
    }

}
