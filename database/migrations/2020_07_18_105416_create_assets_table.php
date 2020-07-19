<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset'); //string is the default varchar type, max len is 256
            $table->text('note')->nullable();
            $table->boolean('has_tag')->default(false);  //set default to false to has_tag field
            $table->timestamps();
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->bigInteger('sublocation_id')->unsigned()->nullable();
            $table->bigInteger('subcategory_id')->unsigned()->nullable();
            $table->string('create_user')->nullable();
            $table->string('update_user')->nullable();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sublocation_id')->references('id')->on('sublocations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        //	PRIMARY	BTREE	是	否	id	0	A	否	
        //	assets_brand_id_foreign	BTREE	否	否	brand_id	0	A	是	
        //	assets_sublocation_id_foreign	BTREE	否	否	sublocation_id	0	A	是	
        //	assets_subcategory_id_foreign	BTREE	否	否	subcategory_id	0	A	是

        //in case we need to drop the table, drop the FK key first
        Schema::table('subcategories', function (Blueprint $table){
            $table->dropForeign('assets_brand_id_foreign');
            $table->dropForeign('assets_sublocation_id_foreign');
            $table->dropForeign('assets_subcategory_id_foreign');
        });

        Schema::dropIfExists('assets');
    }
}
