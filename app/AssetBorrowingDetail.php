<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetBorrowingDetail extends Model
{
    //
    protected $fillable = ['asset_borrowing_main_id', 'asset_id', 'note'];
}
