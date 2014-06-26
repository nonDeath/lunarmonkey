<?php namespace LunarMonkey\Repositories;

use User;
use Illuminate\Events\Dispatcher;
use LunarMonkey\Cache\LaravelCache;
use Illuminate\Support\ServiceProvider;
use LunarMonkey\Repositories\User\CacheDecorator;
use LunarMonkey\Repositories\User\Validators\UserCreateValidator;
use LunarMonkey\Repositories\User\Validators\UserUpdateValidator;
use LunarMonkey\Repositories\User\Validators\UserUpdatePasswordValidator;
use LunarMonkey\Repositories\User\EloquentUserRepository;
use LunarMonkey\Repositories\User\Events\WelcomeEmailHandler;


class RepositoryServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->app->events->subscribe(new WelcomeEmailHandler(
            $this->app['mailer'])
          );
    }

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
            $repository = new EloquentUserRepository( new User, $app['events'] );

            $repository->registerValidator('create', new UserCreateValidator($app['validator']));
            $repository->registerValidator('update', new UserUpdateValidator($app['validator']));

            return new CacheDecorator($repository, new LaravelCache($app['cache'], 'user'));
        });
    }
}
