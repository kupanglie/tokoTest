<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstimatedWorkMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimated_work_mappings', function (Blueprint $table) {
			$table->increments('id');
			$table->string('project_id');
			$table->string('work_id');
			$table->string('qty');
			$table->string('area_desc');
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
        Schema::dropIfExists('estimated_work_mappings');
    }
}
