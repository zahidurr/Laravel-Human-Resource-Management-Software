<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingSummariesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('training_summaries', function(Blueprint $table)
		{
			$table->integer('user_id');
			$table->integer('applicant_id');

			$table->string('training_title', 100);
			$table->string('ts_institute', 100);
			$table->string('ts_location', 100);
			$table->string('training_year', 4);

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
		Schema::drop('training_summaries');
	}

}
