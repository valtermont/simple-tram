<?php

namespace Provectus\Tram\Tests;

use PHPUnit\Framework\TestCase;
use Provectus\Tram\Driver\DriverImpl;
use Provectus\Tram\Route\SimpleRoute;
use Provectus\Tram\TimeTable\TimeTable;
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
        $timeTable = $this->createMock(TimeTable::class);
        $tram->setDriver($driver);
        $tram->setRoute($route);
        $tram->setTimeTable($timeTable);
        $number = $tram->getNumber();
        $this->assertSame('1111', $number);
        $routeNumber = $tram->getRouteNumber();
        $this->assertSame('2', $routeNumber);
        $placeCount = $tram->getAllPlaces();
        $this->assertSame(50, $placeCount);
        $driverName = $tram->getDriver()->getFullName();
        $this->assertSame('John Dow', $driverName);
        $timeTable = $tram->getTimeTable();
        $this->assertNotNull($timeTable);
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
