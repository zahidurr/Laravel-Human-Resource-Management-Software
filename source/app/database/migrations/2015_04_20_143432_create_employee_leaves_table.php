<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeLeavesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employee_leaves', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_id');
			$table->string('type', 50);
			$table->string('from_date', 10);
			$table->string('to_date', 10);
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
		Schema::drop('employee_leaves');
	}

}
