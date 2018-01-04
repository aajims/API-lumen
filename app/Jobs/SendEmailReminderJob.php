<?php

namespace App\Jobs;

use App\Models\User\UserModel;
use Illuminate\Support\Facades\Mail;

class SendEmailReminderJob extends Job
{
    /**
     * @var \App\Models\User\UserModel
     */
    protected $user;

    /**
     * SendReminderEmailJob constructor.
     *
     * @param \App\Models\User\UserModel $user
     */
    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->user;
        $view = 'vendor.email.reminder';
        Mail::send($view, ['user' => $user], function ($msg) use ($user) {
            $email = 'imajinyun@163.com';
            $msg->to($email)->subject('新功能发布');
        });
    }
}
