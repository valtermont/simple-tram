<?php


namespace Provectus\Tram;


class Station
{
    private $name;

    /**
     * Station constructor.
     * @param string $name
     * @throws EmptyStationName
     */
    public function __construct(string $name)
    {
        if (trim($name) === '') {
            throw new EmptyStationName('Station\'s name cannot be emty!');
        }
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}