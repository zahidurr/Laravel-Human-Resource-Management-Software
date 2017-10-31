<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicQualificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('academic_qualifications', function(Blueprint $table)
		{
			$table->integer('user_id');
			$table->integer('applicant_id');

			$table->string('level_of_education', 100);
			$table->string('exam_or_degree_title', 100);
			$table->string('concentration_or_major_or_group', 100);
			$table->string('institute_name', 100);
			$table->string('result', 100);
			$table->string('year_of_passing', 4);
			$table->string('achievement', 100);

			$table->index('user_id');
			$table->index('applicant_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('academic_qualifications');
	}

}
