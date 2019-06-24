<?php


namespace Provectus\Tram\Factories;


use Provectus\Tram\Route\Route;
use Provectus\Tram\Route\SimpleRoute;
use Provectus\Tram\Route\Stations;

class SimpleRouteFactory implements RouteFactory
{
    public function createRoute(Stations $stations): Route
    {
        $route = new SimpleRoute('A1');
        $stationsCount = count($stations);
        for ($i = 0; $i < $stationsCount; $i++) {
            $route->getStations()->add($stations[$i]);
        }
        return $route;
    }
}