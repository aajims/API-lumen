<?php

namespace Tests\Foo\Http;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testExample()
    {
        $this->get('/foo');

        $expect = '{"code":200105,"msg":"Unauthorized","data":[]}';
        self::assertEquals($expect, $this->response->getContent());
    }
}
