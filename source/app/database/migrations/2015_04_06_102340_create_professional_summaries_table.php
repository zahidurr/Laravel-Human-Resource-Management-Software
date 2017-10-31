<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalSummariesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('professional_summaries', function(Blueprint $table)
		{
			$table->integer('user_id');
			$table->integer('applicant_id');

			$table->string('certification', 100);
			$table->string('pq_institute', 100);
			$table->string('pq_location', 100);
			$table->string('pq_from', 10);
			$table->string('pq_to', 10);

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
		Schema::drop('professional_summaries');
	}

}
