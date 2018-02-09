<?php

namespace Tests\User\Http;

use App\Models\User\UserModel;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testCreateUser()
    {
        $prefix = random_int(100000, 99999999);
        $suffix = array_random(['a.a', 'b.b', 'c.c', 'd.d', 'e.e']);
        $parameter = [
            'email'    => $prefix . '@' . $suffix,
            'password' => $prefix,
        ];

        $user = factory(UserModel::class)->create([
            'email'    => $parameter['email'],
            'password' => $parameter['password'],
        ]);
        self::assertGreaterThan(0, $user->id);
        self::assertEquals($parameter['email'], $user->email);
    }

    public function testExistUser()
    {
        $this->seeInDatabase('users', ['email' => 'lumen@qq.com']);
    }
}
