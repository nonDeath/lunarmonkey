<?php namespace LunarMonkey\Repositories\User;

use LunarMonkey\Validators\Validable;
use LunarMonkey\Validators\LaravelValidator;

class UserUpdatePasswordValidator extends LaravelValidator implements Validable {

    /**
     * Validaton rules
     *
     * @var array
     */
    protected $rules = [
        'password'              => 'required|min:7|max:16|confirmed',
        'password_confirmation' => 'required',
    ];
}