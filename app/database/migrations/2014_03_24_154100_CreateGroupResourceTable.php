<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupResourceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_resource', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('group_id')->unsigned();
			$table->integer('resource_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('group_id')->references('id')->on('group');
			$table->foreign('resource_id')->references('id')->on('resource');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('group_resource');
	}

}
