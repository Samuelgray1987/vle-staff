<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportCardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reports_card', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('comment');
			$table->string('student_upn');
			$table->string('staff_upn');
			$table->string('class_id');
			$table->date('staff_completed_at');
			$table->date('management_confirmed_at');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('reports_card');
	}

}
