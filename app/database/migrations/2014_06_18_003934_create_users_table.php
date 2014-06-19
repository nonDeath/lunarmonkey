<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username');
			$table->string('password');
			$table->string('email');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->text('description')->nullable();
			$table->string('url')->nullable();
			$table->string('fb_profile')->nullable();
			$table->string('tw_profile')->nullable();
			$table->string('gp_profile')->nullable();
			$table->string('gravatar_email')->nullable();
			$table->string('capabilities')->nullable();
			$table->boolean('activate')->nullable()->default(0);
			$table->timestamp('activated_at')->nullable();
			$table->string('activation_code')->nullable();
			$table->string('reset_password_code')->nullable();
			$table->timestamp('last_login')->nullable();
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
		Schema::dropIfExists('users');
	}

}
