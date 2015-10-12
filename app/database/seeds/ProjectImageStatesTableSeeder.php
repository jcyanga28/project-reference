<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ProjectImageStatesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('project_image_states')->truncate();

		DB::statement("INSERT INTO project_image_states (id, state) VALUES
			(1, 'Before Painting'),
			(2, 'During Painting'),
			(3, 'After Painting');");
	}

}