<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CompanyStatusTableSeeder extends Seeder {

	public function run()
	{
		DB::table('company_status')->truncate();

		DB::statement("INSERT INTO company_status (id, status) VALUES
			(1, 'FOR APPROVAL'),
			(2, 'APPROVED'),
			(3, 'DENIED');");
	}

}