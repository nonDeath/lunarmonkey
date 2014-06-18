<?php namespace LunarMonkey\Repositories\User;

use LunarMonkey\Validators\Validable;
use LunarMonkey\Validators\LaravelValidator;

class UserCreateValidator extends LaravelValidator implements Validable {

    /**
     * Validaton rules
     *
     * @var array
     */
    protected $rules = [
        'username'              => 'required|alpha_num|unique:users,username',
        'password'              => 'required|min:7|max:16|confirmed',
        'password_confirmation' => 'required',
        'email'                 => 'required|email|unique:users,email'
    ];
}