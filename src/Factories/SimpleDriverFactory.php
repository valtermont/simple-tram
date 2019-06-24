<?php


namespace Provectus\Tram\Factories;


use Provectus\Tram\Driver\Driver;
use Provectus\Tram\Driver\DriverImpl;

class SimpleDriverFactory implements DriverFactory
{
    public function createDriver(): Driver
    {
        return new DriverImpl('John', 'Dow');
    }
}