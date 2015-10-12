<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ContactStatusTableSeeder extends Seeder {

	public function run()
	{
		DB::table('contact_status')->truncate();

		DB::statement("INSERT INTO contact_status (id, status) VALUES
			(1, 'FOR APPROVAL'),
			(2, 'APPROVED'),
			(3, 'DENIED');");

	}

}