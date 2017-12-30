<?php

namespace Tests\Auth\Http;

use Illuminate\Http\Response;
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

        self::assertEquals(Response::HTTP_OK, $this->response->getStatusCode());
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

        self::assertEquals(Response::HTTP_UNAUTHORIZED, $response->status());
    }

    /**
     * Test user authorize.
     *
     * @return void
     */
    public function testAuthorizeAction()
    {
        $parameter = ['email' => 'lumen@qq.com', 'password' => 'lumen'];
        $response = $this->call('POST', '/auth/authorize', $parameter);

        self::assertEquals(Response::HTTP_ACCEPTED, $response->status());
    }
}
