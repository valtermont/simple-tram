<?php


namespace Provectus\Tram;


use Provectus\Tram\Driver\Driver;
use Provectus\Tram\Route\Route;
use Provectus\Tram\TimeTable\TimeTable;

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
    private $onRoute = false;

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
        if ($this->onRoute) {
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
        if ($this->onRoute) {
            throw new ModifyTramError('You cannot change your timetable, when you on route!');
        }
        $this->timeTable = $table;
    }

    public function move()
    {
        $this->isStop = false;
    }

    public function stop()
    {
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

    /**
     * @return mixed
     * @throws TramNotOnRouteError
     */
    public function getCurrentStation()
    {
        if (!$this->onRoute) {
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
        $this->onRoute = true;
    }

    public function finishRoute()
    {
        $this->onRoute = false;
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