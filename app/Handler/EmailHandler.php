<?php

namespace App\Handler;

use App\Models\User\UserModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailHandler extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Models\User\UserModel
     */
    public $user;

    /**
     * EmailHandler constructor.
     *
     * @param \App\Models\User\UserModel $user
     */
    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        \Log::info('email information', [config('mail')]);
        $address = config('address', 'majinyun@xiaohe.com');
        $subject = 'This is a send mail demo.';
        $name = 'A micro application based on Lumen framework';
        $this->view('vendor.email.activate')
             ->from($address, $name)
             ->replyTo($address, $name)
             ->subject($subject)
             ->with(['message' => 'hello world']);
    }
}
