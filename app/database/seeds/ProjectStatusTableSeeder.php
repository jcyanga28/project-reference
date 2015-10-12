<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ProjectStatusTableSeeder extends Seeder {

	public function run()
	{
		DB::table('project_status')->truncate();

		DB::statement("INSERT INTO project_status (id, status) VALUES
			(1, 'FOR APPROVAL'),
			(2, 'APPROVED'),
			(3, 'DENIED');");
	}

}