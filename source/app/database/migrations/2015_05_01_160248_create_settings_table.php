<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('office_hour_start', 4);
			$table->string('office_hour_end', 4);
			$table->tinyInteger('office_weekday_start');
			$table->tinyInteger('office_weekday_end');

			$table->string('ip_range', 20);
			$table->string('weather_zip', 20);
			$table->string('temperature_units', 1);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('settings');
	}

}
