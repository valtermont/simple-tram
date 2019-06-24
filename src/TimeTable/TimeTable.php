<?php


namespace Provectus\Tram\TimeTable;


use ArrayObject;

class TimeTable extends ArrayObject
{
    public function add(ArrivalTime $time)
    {
        $this->append($time);
    }
}