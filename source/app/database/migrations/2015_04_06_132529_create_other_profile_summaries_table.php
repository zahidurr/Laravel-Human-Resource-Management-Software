<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherProfileSummariesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('other_profile_summaries', function(Blueprint $table)
		{
			$table->integer('user_id');
			$table->integer('applicant_id');

			$table->string('ref_name', 100);
			$table->string('ref_organization', 100);
			$table->string('ref_designation', 100);
			$table->string('ref_address', 100);
			$table->string('ref_phone', 100);
			$table->string('ref_email', 100);
			$table->string('ref_relation', 100);

			$table->mediumText('objective');
			$table->mediumText('career_summary');
			$table->mediumText('spacial_qualification');

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
		Schema::drop('other_profile_summaries');
	}

}
