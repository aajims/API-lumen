<?php

namespace Tests\Auth\Http;

use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    /**
     * Test access default.
     *
     * @return void
     */
    public function testDefaultAction()
    {
        $this->get('/');

        self::assertEquals(200, $this->response->getStatusCode());
    }

    /**
     * Test user client get version of Lumen framework.
     */
    public function testVersionAction()
    {
        $this->get('/version');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    /**
     * Test user token information.
     */
    public function testInfoAction()
    {
        $parameter = ['token' => 'abc.xyz.test'];
        $response = $this->call('GET', '/auth/info', $parameter);

        self::assertEquals(401, $response->status());
    }

    /**
     * Test user authorize.
     *
     * @return void
     */
    public function testAuthorizeAction()
    {
        $parameter = ['email' => 'lumen@qq.com', 'password' => 'password'];
        $response = $this->call('GET', '/auth/authorize', $parameter);

        self::assertTrue($response->isOk());
    }
}
