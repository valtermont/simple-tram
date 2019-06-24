<?php


namespace Provectus\Tram\Factories;


use Provectus\Tram\Driver\Driver;
use Provectus\Tram\Route\Route;
use Provectus\Tram\TimeTable\TimeTable;
use Provectus\Tram\Tram;

class SimpleTramFactory implements TramFactory
{
    public function createTram(Driver $driver, Route $route, TimeTable $timeTable): Tram
    {
        $tram = new Tram('AAA594', 50);
        $tram->setDriver($driver);
        $tram->setRoute($route);
        $tram->setTimeTable($timeTable);
        return $tram;
    }
}