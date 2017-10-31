<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentSummariesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employment_summaries', function(Blueprint $table)
		{
			$table->integer('user_id');
			$table->integer('applicant_id');

			$table->string('company_name', 100);
			$table->string('company_location', 100);
			$table->string('position_held', 100);
			$table->string('eh_department', 50);
			$table->mediumText('eh_responsibilities');
			$table->string('eh_from', 10);
			$table->string('eh_to', 10);

			$table->string('experience_category', 100);
			$table->string('skills', 100);

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
		Schema::drop('employment_summaries');
	}

}
