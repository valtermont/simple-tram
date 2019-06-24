<?php


namespace Provectus\Tram\Factories;


use Provectus\Tram\Driver\Driver;
use Provectus\Tram\Route\Route;
use Provectus\Tram\TimeTable\TimeTable;
use Provectus\Tram\Tram;

interface TramFactory
{
    public function createTram(Driver $driver, Route $route, TimeTable $timeTable): Tram;
}