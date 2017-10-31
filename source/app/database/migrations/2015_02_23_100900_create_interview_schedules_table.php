<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewSchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interview_schedules', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('applicant_id');
			$table->integer('job_id');
			$table->string('interview_date', 20);
			$table->tinyInteger('job_status');
			$table->mediumText('reason');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('interview_schedules');
	}

}
