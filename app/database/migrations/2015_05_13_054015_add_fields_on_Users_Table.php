<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFieldsOnUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Users', function($table)
		{
			$table->string('first_name', 100)->after('id');
			$table->string('middle_initial', 100)->before('username');
			$table->string('last_name', 100)->after('middle_initial');
			$table->boolean('confirmed')->after('created_at')->default(1);
			$table->boolean('active')->after('confirmed')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Users', function($table)
		{
			$table->dropColumn('first_name');
			$table->dropColumn('middle_initial');
			$table->dropColumn('last_name');
			$table->dropColumn('confirmed');
			$table->dropColumn('active');
		});
	}

}
