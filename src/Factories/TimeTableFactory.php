<?php


namespace Provectus\Tram\Factories;


use Provectus\Tram\Route\Route;
use Provectus\Tram\TimeTable\TimeTable;

interface TimeTableFactory
{
    public function createTimeTable(Route $route): TimeTable;
}