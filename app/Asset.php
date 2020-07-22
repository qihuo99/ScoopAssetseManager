<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{

    protected $guraded = ['id','created_at','create_user'];
    //We want to define relationship between Assets and brands
    
}
