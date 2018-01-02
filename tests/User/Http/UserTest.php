<?php

namespace Tests\User\Http;

use Tests\TestCase;

class UserTest extends TestCase
{
    public function testCreateAction()
    {
        $prefix = mt_rand(1000, 9999);
        $suffix = array_random([
            'xiaohe.com',
            'gmail.com',
            'live.com',
            'qq.com',
        ]);
        $parameter = [
            'email'    => $prefix . '@' . $suffix,
            'password' => $prefix,
        ];
        $this->call('POST', '/user/register', $parameter);
        self::assertResponseOk();
    }
}
