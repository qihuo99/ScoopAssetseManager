<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->string('subcategory'); //string is the default varchar type, max len is 256
            $table->text('note')->nullable();    
            $table->timestamps();
            $table->string('create_user')->nullable();
            $table->string('update_user')->nullable();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('subcategories', function (Blueprint $table){
            $table->dropForeign('subcategories_category_id_foreign');
        });
        
        Schema::dropIfExists('subcategories');
    }
}
