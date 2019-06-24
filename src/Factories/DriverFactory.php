<?php


namespace Provectus\Tram\Factories;


use Provectus\Tram\Driver\Driver;

interface DriverFactory
{
    public function createDriver(): Driver;
}