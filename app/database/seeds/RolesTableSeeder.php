<?php

class RolesTableSeeder extends Seeder {

	public function run()
	{
		Role::create([
            "name" => "suscriber",
            "description" => "Subscriptor",
            "level" => 0
        ]);

        Role::create([
            "name" => "contributor",
            "description" => "Colaborador",
            "level" => 1
        ]);

        Role::create([
            "name" => "author",
            "description" => "Autor",
            "level" => 2
        ]);

        Role::create([
            "name" => "editor",
            "description" => "Editor",
            "level" => 7
        ]);

        Role::create([
            "name" => "administrator",
            "description" => "Administrador",
            "level" => 10
        ]);
	}

}