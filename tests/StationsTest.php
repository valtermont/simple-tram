<?php

namespace Provectus\Tram\Tests;

use PHPUnit\Framework\TestCase;
use Provectus\Tram\Route\Station;
use Provectus\Tram\Route\Stations;

class StationsTest extends TestCase
{

    public function testAdd()
    {
        $stations = new Stations();
        $station = new Station('Test Station');
        $stations->add($station);
        $this->assertSame($station, $stations[0]);
    }
}
