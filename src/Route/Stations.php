<?php


namespace Provectus\Tram\Route;


use ArrayObject;

class Stations extends ArrayObject
{
    public function add(Station $station)
    {
        $this->append($station);
    }
}