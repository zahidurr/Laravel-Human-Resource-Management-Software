<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 50);
			$table->string('start_date', 10);
			$table->string('end_date', 10);
			$table->string('salary_range', 30);
			$table->string('experience_requirements', 50);
			$table->string('educational_requirements', 100);
			$table->tinyInteger('no_of_vacancies');
			$table->string('job_nature', 20);
			$table->mediumText('additional_requirements');
			$table->longText('description');
			$table->mediumText('other_benefits');
			$table->integer('created_by');
			$table->tinyInteger('open')->default('1');
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
		Schema::drop('jobs');
	}

}
