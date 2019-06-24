<?php

namespace Provectus\Tram\Tests;

use PHPUnit\Framework\TestCase;
use Provectus\Tram\Factories\SimpleDriverFactory;
use Provectus\Tram\Factories\SimpleRouteFactory;
use Provectus\Tram\Factories\SimpleTimeTableFactory;
use Provectus\Tram\Factories\SimpleTramFactory;
use Provectus\Tram\SimpleClient;

class SimpleClientTest extends TestCase
{
    public function testRun()
    {
        $client = new SimpleClient(
            new SimpleDriverFactory(),
            new SimpleRouteFactory(),
            new SimpleTimeTableFactory(),
            new SimpleTramFactory()
        );
        $client->run();
        $this->assertTrue(true);
    }
}
