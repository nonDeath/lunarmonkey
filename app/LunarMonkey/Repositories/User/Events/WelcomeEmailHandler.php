<?php  namespace LunarMonkey\Repositories\User\Events;

use Illuminate\Mail\Mailer;

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

    }

    public function handle($user)
    {
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
    }

}
