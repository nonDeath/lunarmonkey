<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 100) as $index)
		{
			User::create([
                "username" => $faker->userName,
                "password" => Hash::make($faker->word),
                "email" => $faker->email,
                "first_name" => $faker->firstName,
                "last_name" => $faker->lastName,
                "description" => $faker->text,
                "url" => $faker->url,
                "fb_profile" => $faker->url,
                "tw_profile" => $faker->url,
                "gp_profile" => $faker->url,
                "gravatar_email" => $faker->email,
                "activate" => $faker->randomElement(array(0,1)),
                "activated_at" => $faker->dateTime,
                "activation_code" => null,
                "reset_password_code" => null,
                "last_login" => $faker->dateTime,
                "role_id" => $faker->randomElement(array(1,2,3,4,5)),
                "created_at" => $faker->dateTime,
                "updated_at" => $faker->dateTime
			]);
		}
	}

}