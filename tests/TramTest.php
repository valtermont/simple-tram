<?php

namespace Provectus\Tram\Tests;

use PHPUnit\Framework\TestCase;
use Provectus\Tram\Driver\DriverImpl;
use Provectus\Tram\Route\SimpleRoute;
use Provectus\Tram\Route\Station;
use Provectus\Tram\TimeTable\TimeTable;
use Provectus\Tram\Tram;
use Provectus\Tram\TramErrors\ActionDoorError;
use Provectus\Tram\TramErrors\NoPlacesError;
use Provectus\Tram\TramErrors\TramNotOnRouteError;

class TramTest extends TestCase
{
    /**
     * @var Tram
     */
    private $tram;

    protected function setUp(): void
    {
        $driver = new DriverImpl('John', 'Dow');
        $route = new SimpleRoute('2');
        $route->getStations()->add(new Station('1st'));
        $route->getStations()->add(new Station('2nd'));
        $this->tram = new Tram('1111', 50);
        $timeTable = $this->createMock(TimeTable::class);
        $this->tram->setDriver($driver);
        $this->tram->setRoute($route);
        $this->tram->setTimeTable($timeTable);
    }

    public function testCreateModel()
    {
        $tram = new Tram('9458B', 45);
        $this->assertTrue(is_object($tram));
    }

    public function testTramProperties()
    {
        $number = $this->tram->getNumber();
        $this->assertSame('1111', $number);
        $routeNumber = $this->tram->getRouteNumber();
        $this->assertSame('2', $routeNumber);
        $placeCount = $this->tram->getAllPlaces();
        $this->assertSame(50, $placeCount);
        $driverName = $this->tram->getDriver()->getFullName();
        $this->assertSame('John Dow', $driverName);
        $timeTable = $this->tram->getTimeTable();
        $this->assertNotNull($timeTable);
    }

    public function testNotOpenDoorWhenMove()
    {
        $this->expectException(ActionDoorError::class);
        $this->tram->move();
        $this->tram->openDoor();
    }

    public function testSetRoute()
    {
        $this->assertSame('2', $this->tram->getRouteNumber());
    }

    public function testSetTimeTable()
    {
        $this->assertNotNull($this->tram->getTimeTable());
    }

    public function testErrorTakeStationAfterFinishRoute()
    {
        $this->expectException(TramNotOnRouteError::class);
        $this->tram->finishRoute();
        $this->tram->getCurrentStation();
    }

    public function testChangeStationOnStop()
    {
        $this->tram->startRoute();
        $this->assertSame('1st', $this->tram->getCurrentStation()->getName());
        $this->tram->move();
        $this->tram->stop();
        $this->assertSame('2nd', $this->tram->getCurrentStation()->getName());
    }

    public function testMoveWithNotCloseDoor()
    {
        $this->expectException(ActionDoorError::class);
        $this->tram->startRoute();
        $this->tram->openDoor();
        $this->tram->move();
    }

    public function testTakePassengerCloseDoor()
    {
        $this->expectException(ActionDoorError::class);
        $this->tram->startRoute();
        $this->tram->closeDoor();
        $this->tram->takePassengers(10);
    }

    public function testGetCurrentStation()
    {
        $this->tram->startRoute();
        $this->assertSame('1st', $this->tram->getCurrentStation()->getName());
    }

    public function testGetCurrentStationWithoutStart()
    {
        $this->expectException(TramNotOnRouteError::class);
        $this->tram->getCurrentStation();
    }

    public function testTakePassengersMorePlaces()
    {
        $this->expectException(NoPlacesError::class);
        $this->tram->openDoor();
        $this->tram->takePassengers(1000);
    }

    public function testFreePlacesOnTakePassengers()
    {
        $this->tram->openDoor();
        $freePlaces = $this->tram->getAllPlaces();
        $this->tram->takePassengers(20);
        $this->assertSame($freePlaces - 20, $this->tram->getFreePlaces());
    }

    public function testFreePlacesOnLetPassengers()
    {
        $this->tram->openDoor();
        $this->tram->takePassengers(40);
        $freePlaces = $this->tram->getAllPlaces() - 40;
        $this->tram->letPassengers(20);
        $this->assertSame($freePlaces + 20, $this->tram->getFreePlaces());
    }

    public function testFirstStationOnStartRoute()
    {
        $this->tram->startRoute();
        $this->assertSame('1st', $this->tram->getCurrentStation()->getName());
    }

    public function testSetDriver()
    {
        $this->assertSame('John Dow', $this->tram->getDriver()->getFullName());
        $newDriver = new DriverImpl('Jane', 'Law');
        $this->tram->setDriver($newDriver);
        $this->assertSame('Jane Law', $this->tram->getDriver()->getFullName());
    }
}
