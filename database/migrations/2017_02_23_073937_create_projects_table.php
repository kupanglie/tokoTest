<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
			$table->string('worker_id')->nullable();
			$table->string('sales_id')->nullable();
			$table->string('category_id')->nullable();
			$table->string('status_id');
			$table->string('name');
			$table->string('address');
			$table->string('volume')->nullable();
			$table->date('start_nego')->nullable();
			$table->date('end_nego')->nullable();
			$table->string('work_plan')->nullable();
			$table->date('start_working')->nullable();
			$table->date('end_working')->nullable();
			$table->string('opname_is')->nullable();
			// $table->date('payment_date')->nullable();
			$table->string('payment_value')->nullable();
			$table->string('cost_value')->nullable();
			$table->string('omset_sales')->nullable();
			$table->string('profit')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
