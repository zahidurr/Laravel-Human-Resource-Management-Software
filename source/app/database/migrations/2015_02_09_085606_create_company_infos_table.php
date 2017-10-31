<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyInfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company_infos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 50);
			$table->string('phone', 20);
			$table->string('email', 20);
			$table->string('website', 100);
			$table->mediumText('address');
			$table->mediumText('about');
			$table->string('latitude', 20);
			$table->string('longitude', 20);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('company_infos');
	}

}
