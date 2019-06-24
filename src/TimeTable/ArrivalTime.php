<?php


namespace Provectus\Tram\TimeTable;


use DateTime;
use Provectus\Tram\Route\Station;

class ArrivalTime
{
    private $station;

    private $time;

    private $duration;

    public function __construct(Station $station, DateTime $time, int $secDuration)
    {
        $this->station = $station;
        $this->time = $time;
        $this->duration = $secDuration;
    }
}