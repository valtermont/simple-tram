<?php

namespace Provectus\Tram\Tests;

use PHPUnit\Framework\TestCase;
use Provectus\Tram\Driver\DriverImpl;
use Provectus\Tram\Route\SimpleRoute;
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
        $route = new SimpleRoute('2');
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

    public function testOpenDoor()
    {

    }

    public function testSetRoute()
    {

    }

    public function testSetTimeTable()
    {

    }

    public function testFinishRoute()
    {

    }

    public function testStop()
    {

    }

    public function testMove()
    {

    }

    public function testCloseDoor()
    {

    }

    public function testGetCurrentStation()
    {

    }

    public function testTakePassengers()
    {

    }

    public function testLetPassengers()
    {

    }

    public function testStartRoute()
    {

    }

    public function testSetDriver()
    {

    }
}
