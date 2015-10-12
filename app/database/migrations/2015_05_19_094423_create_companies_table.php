<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function($table)
		{
			$table->increments('id');
			$table->string('company_name', 100);
			$table->integer('contact_id')->unsigned();
			$table->foreign('contact_id')->references('id')->on('contacts');
			$table->integer('type_id')->unsigned();
			$table->foreign('type_id')->references('id')->on('types');
			$table->string('street', 50);
			$table->integer('city_id')->unsigned();
			$table->foreign('city_id')->references('id')->on('cities');
			$table->integer('province_id')->unsigned();
			$table->foreign('province_id')->references('id')->on('provinces');
			$table->string('region', 50);
			$table->string('country', 50);
			$table->string('zip_code', 50);
			$table->string('telephone_number', 50);
			$table->string('fax_number', 50);
			$table->string('mobile_number', 50);
			$table->string('email', 50);
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
		Schema::drop('companies');
	}

}
