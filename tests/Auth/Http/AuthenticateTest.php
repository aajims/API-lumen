<?php

namespace Tests\Auth\Http;

use Illuminate\Http\Response;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    /**
     * Test access default.
     */
    public function testHomeAction()
    {
        $this->get('/');

        $this->assertResponseOk();
        self::assertEquals(Response::HTTP_OK, $this->response->getStatusCode());
    }

    /**
     * Test user client get version of Lumen framework.
     */
    public function testVersionAction()
    {
        $this->get('/version');

        self::assertEquals(
            $this->app->version(),
            $this->response->getContent()
        );
    }

    /**
     * Test some action.
     */
    public function testSomeAction()
    {
        $parameter = ['token' => 'abc.xyz.test'];
        foreach (['/auth/info', '/auth/user', '/auth/refresh'] as $item) {
            $response = $this->call('GET', $item, $parameter);

            self::assertEquals(
                Response::HTTP_UNAUTHORIZED,
                $response->status()
            );
        }
    }

    /**
     * Test user authorize.
     */
    public function testAuthorizeAction()
    {
        $parameter = ['email' => 'lumen@qq.com', 'password' => 'lumen'];
        $response = $this->call('POST', '/auth/authorize', $parameter);
        self::assertEquals($response->status(), Response::HTTP_OK);
    }
}
