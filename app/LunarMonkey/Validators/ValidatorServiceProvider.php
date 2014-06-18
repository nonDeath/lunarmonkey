<?php namespace LunarMonkey\Validators;

use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider {

    /**
     * Register
     *
     * @return void
     */
    public function register(){}

    /**
     * Boot
     *
     * @return void
     */
    public function boot()
    {
        $this->app->validator->resolver(function($translator, $data, $rules, $messages)
        {
            return new NameValidator($translator, $data, $rules, $messages);
        });
    }
}