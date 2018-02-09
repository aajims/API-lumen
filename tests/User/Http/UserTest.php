<?php

namespace Tests\User\Http;

use App\Models\User\UserModel;
use Tests\TestCase;

class UserTest extends TestCase
{
    private $user;

    public function setUp()
    {
        parent::setUp();

        $prefix = random_int(10000, 999999);
        $suffix = array_random(['a.a', 'b.b', 'c.c', 'd.d', 'e.e']);
        $parameter = [
            'email'    => $prefix . '@' . $suffix,
            'password' => $prefix,
        ];

        $this->user = factory(UserModel::class)->create([
            'email'    => $parameter['email'],
            'password' => $parameter['password'],
        ]);
    }

    public function testExistUser()
    {
        $this->seeInDatabase('users', ['email' => 'lumen@qq.com']);
    }
}
