<?php


namespace Provectus\Tram\Route;


interface Route
{
    function getNumber(): string;

    function getStations(): Stations;
}