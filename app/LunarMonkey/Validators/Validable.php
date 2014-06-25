<?php namespace LunarMonkey\Validators;

interface Validable {

    /**
     * Determine if the data passes the validation rules
     *
     * @return boolean
     */
    public function passes();

    /**
     * Return the errors
     *
     * @return Illuminate\Support\MessageBag
     */
    public function errors();
}