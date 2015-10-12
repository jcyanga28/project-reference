<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvincesTable extends Migration {


	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('provinces', function($table){
			$table->increments('id');
			$table->string('province');
			$table->integer('state_id')->unsigned();
			$table->foreign('state_id')->references('id')->on('states');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('provinces', function ($table) {
            $table->dropForeign('provinces_state_id_foreign');
        });
		Schema::drop('provinces');
	}

	

}
