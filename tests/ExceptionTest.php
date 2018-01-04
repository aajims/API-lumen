<?php

namespace Tests;

class ExceptionTest extends TestCase
{
    public function testNotFoundException()
    {
        $response = $this->call('GET', '/http/exception');

        self::assertEquals(404, $response->status());
    }

    public function testAuthenticateException()
    {
        $response = $this->call('GET', '/auth/info');

        self::assertEquals(401, $response->status());
    }
}
