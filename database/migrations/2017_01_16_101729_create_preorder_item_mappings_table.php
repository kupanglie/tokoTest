<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreorderItemMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preorder_item_mappings', function (Blueprint $table) {
            $table->increments('id');
			$table->string('item_id');
			$table->string('preorder_id');
			$table->string('length_id')->nullable();
			$table->string('thick_id')->nullable();
			$table->string('qty');
			$table->string('length')->nullable();
			$table->string('actual_length')->nullable();
			$table->string('actual_qty')->nullable();
			$table->string('price')->nullable();
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
        Schema::dropIfExists('preorder_item_mappings');
    }
}
