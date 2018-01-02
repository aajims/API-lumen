<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use App\Handler\EmailHandler;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

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
     * @param \App\Events\SendEmailEvent $event
     *
     * @return void
     */
    public function handle(SendEmailEvent $event)
    {
        $user = $event->user;

        Mail::to('imajinyun@163.com')->send(new EmailHandler($user));
    }
}
