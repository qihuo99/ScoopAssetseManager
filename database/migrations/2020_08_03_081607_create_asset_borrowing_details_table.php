<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetBorrowingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_borrowing_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('asset_borrowing_main_id')->unsigned();
            $table->string('asset_id'); //string is 
            $table->string('note')->nullable(); 
            $table->timestamps();
            $table->string('create_user')->nullable();
            $table->string('update_user')->nullable();

            $table->foreign('asset_borrowing_main_id')->references('id')->on('asset_borrowing_mains')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //in case we need to drop the table, drop the FK key first
        Schema::table('asset_borrowing_details', function (Blueprint $table){
            $table->dropForeign('asset_borrowing_details_asset_borrowing_main_id_foreign');
        });
        
        Schema::dropIfExists('asset_borrowing_details');
    }
}
