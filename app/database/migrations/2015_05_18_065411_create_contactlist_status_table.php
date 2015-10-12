<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactlistStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contactlist_status', function($table)
		{
			$table->increments('id');
			$table->integer('contact_id')->unsigned();
			$table->foreign('contact_id')->references('id')->on('contacts');
			$table->integer('status_id')->unsigned();
			$table->foreign('status_id')->references('id')->on('contact_status');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contactlist_status');
	}

}
