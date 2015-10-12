<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->datetime('date_reported');
			$table->integer('bdo_id')->unsigned();
			$table->foreign('bdo_id')->references('user_id')->on('assigned_areas');
			$table->integer('area_id')->unsigned();
			$table->foreign('area_id')->references('area_id')->on('assigned_areas');
			$table->string('project_name', 255);
			$table->string('project_owner', 255);
			$table->integer('developer')->unsigned();
			$table->foreign('developer')->references('id')->on('contacts');
			$table->integer('general_contractor')->unsigned();
			$table->foreign('general_contractor')->references('id')->on('contacts');
			$table->integer('project_mgr_designer')->unsigned();
			$table->foreign('project_mgr_designer')->references('id')->on('contacts');
			$table->integer('architect')->unsigned();
			$table->foreign('architect')->references('id')->on('contacts');
			$table->integer('applicator')->unsigned();
			$table->foreign('applicator')->references('id')->on('contacts');
			$table->integer('dealer_supplier')->unsigned();
			$table->foreign('dealer_supplier')->references('id')->on('contacts');
			$table->integer('project_classification')->unsigned();
			$table->foreign('project_classification')->references('id')->on('classifications');
			$table->integer('project_category')->unsigned();
			$table->foreign('project_category')->references('id')->on('categories');
			$table->integer('project_stage')->unsigned();
			$table->foreign('project_Stage')->references('id')->on('stages');
			$table->integer('project_status')->unsigned();
			$table->foreign('project_status')->references('id')->on('statuses');
			$table->text('project_details');
			$table->integer('status');
			$table->integer('notif');
			$table->date('notif_dt');
			$table->integer('created_by')->unsigned();
			$table->foreign('created_by')->references('id')->on('users');
			$table->integer('approved_by')->unsigned();
			$table->foreign('approved_by')->references('id')->on('users');
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
		Schema::drop('projects');
	}

}
