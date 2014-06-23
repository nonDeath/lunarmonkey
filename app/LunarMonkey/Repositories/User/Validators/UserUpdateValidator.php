<?php namespace LunarMonkey\Repositories\User\Validators;

use LunarMonkey\Validators\Validable;
use LunarMonkey\Validators\LaravelValidator;

class UserUpdateValidator extends LaravelValidator implements Validable {

    /**
     * Validaton rules
     *
     * @var array
     */
    protected $rules = [
        'password' => 'min:7|max:16|confirmed',
        'email'    => 'required|email|unique:users,email,{id}',
    ];
}