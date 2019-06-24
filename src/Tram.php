<?php


namespace Provectus\Tram;


use Provectus\Tram\Driver\Driver;

class Tram
{
    private $number;

    private $placesCount;

    private $driver;

    public function __construct(string $number, int $placesCount)
    {
        $this->number = $number;
        $this->placesCount = $placesCount;
    }

    public function setDriver(Driver $driver)
    {
        $this->driver = $driver;
    }
}