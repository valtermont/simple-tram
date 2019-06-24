<?php


namespace Provectus\Tram;


use Provectus\Tram\Factories\DriverFactory;
use Provectus\Tram\Factories\RouteFactory;
use Provectus\Tram\Factories\TimeTableFactory;
use Provectus\Tram\Factories\TramFactory;
use Provectus\Tram\Route\Station;
use Provectus\Tram\Route\Stations;

class SimpleClient
{
    private $stations;

    private $tram;

    public function __construct(
        DriverFactory $driverFactory,
        RouteFactory $routeFactory,
        TimeTableFactory $timeTableFactory,
        TramFactory $tramFactory
    )
    {
        $this->stations = new Stations();
        $this->stations->add(new Station('1st Station'));
        $this->stations->add(new Station('2nd Station'));
        $this->stations->add(new Station('3rd Station'));
        $driver = $driverFactory->createDriver();
        $route = $routeFactory->createRoute($this->stations);
        $timetable = $timeTableFactory->createTimeTable($route);
        $this->tram = $tramFactory->createTram($driver, $route, $timetable);
    }

    public function run()
    {
        $this->tram->startRoute();
        $this->tram->openDoor();
        $this->tram->takePassengers(10);
        $this->tram->closeDoor();
        $this->printTramState();
        $this->tram->move();
        $this->tram->stop();
        $this->tram->openDoor();
        $this->tram->letPassengers(7);
        $this->tram->takePassengers(15);
        $this->tram->closeDoor();
        $this->printTramState();
        $this->tram->move();
        $this->tram->stop();
        $this->tram->openDoor();
        $this->tram->letPassengers(18);
        $this->tram->closeDoor();
        $this->printTramState();
        $this->tram->finishRoute();
    }

    private function printTramState()
    {
        $number = $this->tram->getNumber();
        $routeNumber = $this->tram->getRouteNumber();
        $placeCount = $this->tram->getAllPlaces();
        echo 'Tram number: ' . $number . "\n";
        echo 'Route number: ' . $routeNumber . "\n";
        echo 'Current station: ' . $this->tram->getCurrentStation()->getName() . "\n";
        echo 'All places: ' . $placeCount . "\n";
        echo 'Free places: ' . $this->tram->getFreePlaces() . "\n";
        echo '-----------------------' . "\n";
    }
}