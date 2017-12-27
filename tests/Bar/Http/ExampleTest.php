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

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }
}
