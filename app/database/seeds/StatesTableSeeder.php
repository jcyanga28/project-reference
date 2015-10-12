<?php


class StatesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('states')->truncate();

		DB::statement("INSERT INTO states (id, state) VALUES
			(1, 'LUZON'),
			(2, 'VISAYAS'),
			(3, 'MINDANAO');");
	}

}