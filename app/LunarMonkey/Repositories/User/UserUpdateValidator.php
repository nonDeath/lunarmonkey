<?php namespace LunarMonkey\Repositories\User;

use LunarMonkey\Validators\Validable;
use LunarMonkey\Validators\LaravelValidator;

class UserUpdateValidator extends LaravelValidator implements Validable {

    /**
     * Validaton rules
     *
     * @var array
     */
    protected $rules = [
        'username' => 'required|alpha_num|unique:users,username,{id}',
        'email' => 'required|email|unique:users,email,{id}'
    ];
}