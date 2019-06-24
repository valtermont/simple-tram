<?php


namespace Provectus\Tram\Factories;


use Provectus\Tram\Route\Route;
use Provectus\Tram\Route\Stations;

interface RouteFactory
{
    public function createRoute(Stations $stations): Route;
}