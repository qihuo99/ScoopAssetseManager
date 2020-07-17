<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSublocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sublocations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('location_id')->unsigned();
            $table->string('sublocation'); //string is the default varchar type, max len is 256
            $table->text('note')->nullable();    
            $table->timestamps();
            $table->string('create_user')->nullable();
            $table->string('update_user')->nullable();

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade')->onUpdate('cascade');
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
       Schema::table('sublocations', function (Blueprint $table){
            $table->dropForeign('sublocations_location_id_foreign');
        });

        Schema::dropIfExists('sublocations');
    }
}
