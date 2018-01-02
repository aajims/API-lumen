<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailListener
{
    /**
     * SendEmailListener constructor.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  SendEmailEvent $event
     *
     * @return void
     */
    public function handle(SendEmailEvent $event)
    {
        $email = $event->user->email;
    }
}
