<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	protected $fillable = [
		"username",
		"password",
		"email",
		"first_name",
		"last_name",
		"description",
		"url",
		"fb_profile",
		"tw_profile",
		"gp_profile",
		"gravatar_email",
		"activate",
		"activated_at",
		"activation_code",
		"reset_password_code",
		"role_id",
		"last_login"
	];

	public function role()
	{
		return $this->belongsTo("Role");
	}

}
