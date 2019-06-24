<?php

namespace Provectus\Tram\Tests;

use PHPUnit\Framework\TestCase;
use Provectus\Tram\Route\EmptyStationName;
use Provectus\Tram\Route\Station;

class StationTest extends TestCase
{
    public function testGetName()
    {
        $station = new Station('1st station');
        $this->assertSame('1st station', $station->getName());
    }

    /** @dataProvider wrongStationNamesProvider */
    public function testEmptyName($wrongName)
    {
        $this->expectException(EmptyStationName::class);
        new Station($wrongName);
    }

    public function wrongStationNamesProvider()
    {
        return [
            [''],
            ['    '],
            ['           '],
            ['
            ']
        ];
    }
}
