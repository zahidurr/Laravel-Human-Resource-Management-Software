<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('applicants', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->string('email', 100);
			$table->string('alternative_email', 100);
			$table->string('phone', 30);
			$table->string('alternative_phone', 30);
			$table->string('ssn', 30);
			$table->string('dob', 10);
			$table->tinyInteger('gender')->default('1');
			$table->tinyInteger('marital_status')->default('1');
			$table->string('nationality', 20);
			$table->string('religion', 20);
			$table->string('father_name', 50);
			$table->string('mother_name', 50);
			$table->mediumText('address');

			$table->string('profile_image', 20);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('applicants');
	}

}
