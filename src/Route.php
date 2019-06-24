<?php


namespace Provectus\Tram;


interface Route
{
    function getNumber(): string;

    function getStations(): Stations;
}