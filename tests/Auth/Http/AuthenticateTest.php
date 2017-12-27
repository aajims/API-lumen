<?php

namespace Tests\Auth\Http;

use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDefaultAction()
    {
        $this->get('/auth');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    public function testAuthorizeAction()
    {
        $parameter = ['email' => 'lumen@qq.com', 'password' => 'password'];
        $response = $this->call('GET', '/auth/authorize', $parameter);

        $expect = '{"status":true,"data":[],"msg":"user not found.","code":200101}';
        self::assertEquals($expect, $response->getContent());
    }
}
