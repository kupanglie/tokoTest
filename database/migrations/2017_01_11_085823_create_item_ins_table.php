<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_ins', function (Blueprint $table) {
            $table->increments('id');
			$table->string('item_mapping_id');
			$table->string('preorder_id')->nullable();
			$table->string('project_id')->nullable();
			$table->integer('qty');
			$table->string('information')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_ins');
    }
}
