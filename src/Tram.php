<?php


namespace Provectus\Tram;


use Provectus\Tram\Driver\Driver;
use Provectus\Tram\Route\Route;
use Provectus\Tram\Route\Station;
use Provectus\Tram\TimeTable\TimeTable;
use Provectus\Tram\TramErrors\ActionDoorError;
use Provectus\Tram\TramErrors\ModifyTramError;
use Provectus\Tram\TramErrors\NoPlacesError;
use Provectus\Tram\TramErrors\StartRouteError;
use Provectus\Tram\TramErrors\TramNotOnRouteError;

class Tram
{
    /** @var string */
    private $number;

    /** @var int */
    private $placesCount;

    /** @var int */
    private $passengersCount;

    /** @var Driver */
    private $driver;

    /** @var Route */
    private $route;

    /** @var TimeTable */
    private $timeTable;

    /** @var bool */
    private $isOnRoute = false;

    /** @var bool */
    private $isStop = true;

    /** @var bool */
    private $isDoorOpen = false;

    /** @var int */
    private $stationIndex = 0;

    public function __construct(string $number, int $placesCount)
    {
        $this->number = $number;
        $this->placesCount = $placesCount;
        $this->passengersCount = 0;
    }

    /**
     * @param Driver $driver
     * @throws ModifyTramError
     */
    public function setDriver(Driver $driver)
    {
        if (!$this->isStop) {
            throw new ModifyTramError('You cannot change driver, when tram rides!');
        }
        $this->driver = $driver;
    }

    /**
     * @param Route $route
     * @throws ModifyTramError
     */
    public function setRoute(Route $route)
    {
        if ($this->isOnRoute) {
            throw new ModifyTramError('You cannot change route, when you on route!');
        }
        $this->route = $route;
    }

    /**
     * @param TimeTable $table
     * @throws ModifyTramError
     */
    public function setTimeTable(TimeTable $table)
    {
        if ($this->isOnRoute) {
            throw new ModifyTramError('You cannot change your timetable, when you on route!');
        }
        $this->timeTable = $table;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getRouteNumber(): string
    {
        return $this->route->getNumber();
    }

    public function getAllPlaces(): int
    {
        return $this->placesCount;
    }

    public function getDriver(): Driver
    {
        return $this->driver;
    }

    public function getTimeTable(): TimeTable
    {
        return $this->timeTable;
    }

    /**
     * @throws ActionDoorError
     */
    public function move()
    {
        if ($this->isDoorOpen) {
            throw new ActionDoorError('You cannot rides with open door!');
        }
        $this->isStop = false;
    }

    public function stop()
    {
        if ($this->isOnRoute) {
            $this->stationIndex++;
        }
        $this->isStop = true;
    }

    /**
     * @throws ActionDoorError
     */
    public function openDoor()
    {
        if (!$this->isStop) {
            throw new ActionDoorError('You cannot open door, when tram rides!');
        }
        $this->isDoorOpen = true;
    }

    /**
     * @throws ActionDoorError
     */
    public function closeDoor()
    {
        if (!$this->isStop) {
            throw new ActionDoorError('You cannot close door, when tram rides!');
        }
        $this->isDoorOpen = false;
    }

    /**
     * @param int $count
     * @throws ActionDoorError
     * @throws NoPlacesError
     */
    public function takePassengers(int $count)
    {
        $this->checkPassengerActionEnable();
        if ($this->passengersCount + $count > $this->placesCount) {
            throw new NoPlacesError('Sorry, but places ended');
        }
        $this->passengersCount += $count;
    }

    /**
     * @param int $count
     * @throws ActionDoorError
     * @throws NoPlacesError
     */
    public function letPassengers(int $count)
    {
        $this->checkPassengerActionEnable();
        if ($this->passengersCount < $count) {
            throw new NoPlacesError('Sorry, but you haven\'t so many passengers');
        }
        $this->passengersCount -= $count;
    }

    public function getFreePlaces(): int
    {
        return $this->placesCount - $this->passengersCount;
    }

    /**
     * @return Station
     * @throws TramNotOnRouteError
     */
    public function getCurrentStation()
    {
        if (!$this->isOnRoute) {
            throw new TramNotOnRouteError('You need start route!');
        }
        return $this->route->getStations()[$this->stationIndex];
    }

    /**
     * @throws StartRouteError
     */
    public function startRoute()
    {
        if ($this->route === null) {
            throw new StartRouteError('You cannot start route without route!');
        }
        if ($this->driver === null) {
            throw new StartRouteError('You cannot start route without driver!');
        }
        if ($this->timeTable === null) {
            throw new StartRouteError('You cannot start route without timetable!');
        }
        $this->isOnRoute = true;
    }

    public function finishRoute()
    {
        $this->isOnRoute = false;
    }

    /**
     * @throws ActionDoorError
     */
    private function checkPassengerActionEnable()
    {
        if (!$this->isStop) {
            throw new ActionDoorError('You cannot take passengers, when tram rides!');
        }
        if (!$this->isDoorOpen) {
            throw new ActionDoorError('You cannot take passengers, when door closes!');
        }
    }
}