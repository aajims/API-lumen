<?php

namespace Tests\Foo\Http;

use App\Http\Foo\Controllers\ExampleController;
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
        $this->get('/foo');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    /**
     * @return void
     */
    public function testListAction()
    {
        $controller = new ExampleController();
        $array = $controller->listAction();

        self::assertArrayHasKey('foo', $array);
    }
}
