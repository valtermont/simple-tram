<?php


namespace Provectus\Tram\Route;


class SimpleRoute implements Route
{
    private $number;

    private $stations;

    /**
     * SimpleRoute constructor.
     * @param string $number
     * @throws WrongRouteNumber
     */
    public function __construct(string $number)
    {
        if (trim($number) === '' || mb_strlen($number) > 100) {
            throw new WrongRouteNumber("'$number' is not right number");
        }
        $this->number = $number;
        $this->stations = new Stations();
    }

    function getNumber(): string
    {
        return $this->number;
    }

    function getStations(): Stations
    {
        return $this->stations;
    }
}