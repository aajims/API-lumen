<?php

namespace Tests\Auth\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    public function testHomeAction()
    {
        $this->get('/');

        $this->assertResponseOk();
        self::assertEquals(Response::HTTP_OK, $this->response->getStatusCode());
    }

    public function testVersionAction()
    {
        $this->get('/version');

        self::assertEquals(
            $this->app->version(),
            $this->response->getContent()
        );
    }

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

    public function testAuthorizeAction()
    {
        $parameter = ['email' => 'lumen@qq.com', 'password' => 'lumen'];
        $response = $this->call('POST', '/auth/authorize', $parameter);
        self::assertInstanceOf(JsonResponse::class, $response);
    }

    protected function parseJson(JsonResponse $jsonResponse)
    {
        return json_decode($jsonResponse->getContent());
    }
}
