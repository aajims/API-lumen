<?php

namespace Tests\Bar\Http;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/bar');

        $expect = '{"code":200105,"msg":"Unauthorized","data":[]}';
        self::assertEquals($expect, $this->response->getContent());
    }
}
