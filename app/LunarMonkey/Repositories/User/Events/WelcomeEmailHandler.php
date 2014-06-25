<?php  namespace LunarMonkey\Repositories\User\Events;

use Illuminate\Mail\Mailer;
use Log;
class WelcomeEmailHandler {

    /**
     * The mailer instance
     *
     * @var Illuminate\Mail\Mailer
     */
    protected $mailer;

    /**
     * Create a new instance of the WelcomeEmailHandler
     *
     * @param Illuminate\Mail\Mailer $mailer
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
        Log::info('Ingreso al constructor');
    }

    public function handle($user)
    {
        Log::info('Ingreso al handle');
        die("hello world!");
    }

    /**
    * Register the listeners for the subscriber.
    *
    * @param Illuminate\Events\Dispatcher $events
    * @return array
    */
    public function subscribe($events)
    {
        $events->listen('user.welcome', 'LunarMonkey\Repositories\User\Events\WelcomeEmailHandler');
        Log::info('Ingreso al subscriber');
    }

}