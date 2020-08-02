<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetBorrowingMainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_borrowing_mains', function (Blueprint $table) {
            $table->id();
            $table->string('asset_id_selected')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->string('create_user')->nullable();
            $table->string('update_user')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_borrowing_mains');
    }
}
