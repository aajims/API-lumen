<?php

namespace App\Events;

use App\Models\User\UserModel;

class SendEmailEvent extends Event
{
    /**
     * @var \App\Models\User\UserModel
     */
    public $user;

    /**
     * SendEmailEvent constructor.
     *
     * @param \App\Models\User\UserModel $user
     */
    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }
}
