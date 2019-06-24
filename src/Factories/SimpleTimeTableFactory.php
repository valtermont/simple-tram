<?php


namespace Provectus\Tram\Factories;


use DateTime;
use Provectus\Tram\Route\Route;
use Provectus\Tram\TimeTable\ArrivalTime;
use Provectus\Tram\TimeTable\TimeTable;

class SimpleTimeTableFactory implements TimeTableFactory
{
    /**
     * @param Route $route
     * @return TimeTable
     * @throws CreateTimeTableError
     */
    public function createTimeTable(Route $route): TimeTable
    {
        $countStations = $route->getStations()->count();
        if ($countStations < 2) {
            throw new CreateTimeTableError('Count stations for timetable need be more then 1');
        }
        $timeTable = new TimeTable();
        $startTime = DateTime::createFromFormat('H:i', '08:00');
        for ($i = 0; $i < $countStations; $i++) {
            $arrival = new ArrivalTime($route->getStations()[$i], $startTime, 10);
            $timeTable->add($arrival);
            $min = rand(5, 10);
            $startTime->modify("+{$min} minutes");
        }
        return $timeTable;
    }
}