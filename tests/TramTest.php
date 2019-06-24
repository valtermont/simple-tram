<?php


namespace Provectus\Tram\Tests;


use PHPUnit\Framework\TestCase;
use Provectus\Tram\DriverImpl;
use Provectus\Tram\Tram;

class TramTest extends TestCase
{
    public function testCreateModel()
    {
        $tram = new Tram('9458B', 45);
        $this->assertTrue(is_object($tram));
    }

    public function testTramProperties()
    {
        $driver = new DriverImpl('John', 'Dow');
        $tram = new Tram('1111', 50);
        $tram->setDriver($driver);
        $tram->setRoute($route);
        $tram->setTimeTable($timeTable);

        $number = $tram->getNumber();
        $routeNumber = $tram->getRouteNumber();
        $placeCount = $tram->getPlacesCount();
        $driver = $tram->getDriver();
        $timeTable = $tram->getTimeTable();

    }


}
