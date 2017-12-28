<?php

namespace Tests\Auth\Http;

use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    /**
     * Test access default action.
     *
     * @return void
     */
    public function testDefaultAction()
    {
        $this->get('/');

        self::assertEquals(200, $this->response->getStatusCode());
    }

    /**
     * Test get version action.
     */
    public function testVersionAction()
    {
        $this->get('/version');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    /**
     * Test user authorize action.
     *
     * @return void
     */
    public function testAuthorizeAction()
    {
        $parameter = ['email' => 'lumen@qq.com', 'password' => 'password'];
        $response = $this->call('POST', '/auth/authorize', $parameter);

        self::assertFalse($response->isOk());
    }
}
