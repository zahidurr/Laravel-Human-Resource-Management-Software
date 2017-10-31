<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeAttendancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employee_attendances', function(Blueprint $table)
		{
			$table->integer('employee_id');
			$table->string('punch_month', 30);
			$table->string('punch_date', 10);
			$table->string('in_time', 5);
			$table->string('out_time', 5);
			$table->string('punch_type', 1);

			$table->index('punch_month');
			$table->index('employee_id');
			$table->index('punch_date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employee_attendances');
	}

}
