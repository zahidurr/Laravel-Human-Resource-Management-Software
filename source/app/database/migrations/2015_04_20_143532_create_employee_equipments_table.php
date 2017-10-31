<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeEquipmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employee_equipments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_id');
			$table->string('name', 50);
			$table->string('quantity', 20);
			$table->longText('reason');
			$table->tinyInteger('status');
			$table->integer('moderated_by');
			$table->longText('moderator_comment');
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
		Schema::drop('employee_equipments');
	}

}
