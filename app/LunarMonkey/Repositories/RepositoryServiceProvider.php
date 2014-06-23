<?php namespace LunarMonkey\Repositories;

use User;
use LunarMonkey\Cache\LaravelCache;
use Illuminate\Support\ServiceProvider;
use LunarMonkey\Repositories\User\CacheDecorator;
use LunarMonkey\Repositories\User\Validators\UserCreateValidator;
use LunarMonkey\Repositories\User\Validators\UserUpdateValidator;
use LunarMonkey\Repositories\User\Validators\UserUpdatePasswordValidator;
use LunarMonkey\Repositories\User\EloquentUserRepository;

class RepositoryServiceProvider extends ServiceProvider {

    /**
     * Register
     *
     */
    public function register()
    {
        $this->registerUserRepository();
    }

    /**
     * Register the user repository
     *
     * @return void
     */
    public function registerUserRepository()
    {
        $this->app->bind("LunarMonkey\Repositories\User\UserRepository", function($app)
        {
            $repository = new EloquentUserRepository( new User );

            $repository->registerValidator('create', new UserCreateValidator($app['validator']));
            $repository->registerValidator('update', new UserUpdateValidator($app['validator']));

            return new CacheDecorator($repository, new LaravelCache($app['cache'], 'user'));
        });
    }
}