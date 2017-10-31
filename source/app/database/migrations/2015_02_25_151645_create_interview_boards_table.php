<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewBoardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interview_boards', function(Blueprint $table)
		{
			$table->integer('interview_schedule_id');
			$table->integer('interview_by');
			$table->integer('selected');
			$table->integer('accepted');
			$table->integer('marks');
			$table->longText('comment');

			$table->index('interview_schedule_id');
			$table->index('interview_by');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('interview_boards');
	}

}
