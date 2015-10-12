<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		// DB::table('departments')->truncate();
	 //    $department = new Department;
	 //    $department->department_desc = 'ADMIN';
	 //    $department->save();

	    DB::table('roles')->truncate();
	    $role = new Role;
		$role->name = 'ADMINISTRATOR';
		$role->save();

		DB::table('users')->truncate();
		DB::table('assigned_roles')->truncate();
		$user = new User;
	    $user->username = 'admin';
	    $user->email = 'admin@prs.com';
	    $user->password = '031988';
	    $user->password_confirmation = '031988';
	    $user->confirmation_code = md5(uniqid(mt_rand(), true));
	    // $user->confirmed = 1;
	    // $user->active = 1;
	    // $user->department_id = $department->id;
	    $user->save();

		$user->roles()->attach($role->id); // id only
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

}