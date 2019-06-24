<?php


namespace Provectus\Tram\Driver;


class DriverImpl implements Driver
{
    private $firstName;

    private $lastName;

    private $secondName;

    /**
     * DriverImpl constructor.
     * @param string $firstName
     * @param string $secondName
     * @param string $lastName
     * @throws WrongDriverName
     */
    public function __construct(string $firstName, string $secondName, string $lastName = '')
    {
        if (!$this->validateName($firstName)) {
            throw new WrongDriverName("'$firstName' is invalid first name!");
        }
        if (!$this->validateName($secondName)) {
            throw new WrongDriverName("'$secondName' is invalid second name!");
        }
        if (!($this->validateName($lastName) || $lastName === '')) {
            throw new WrongDriverName("'$lastName' is invalid last name!");
        }
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->secondName = $secondName;
    }

    private function validateName(string $name): bool
    {
        $namesRegExpr = "/^\p{Lu}[\p{L} '&-]*[\p{L}]$/u";
        return preg_match($namesRegExpr, $name) === 1;
    }

    function getFullName(): string
    {
        return trim($this->firstName . ' ' . $this->secondName . ' ' . $this->lastName);
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getSecondName(): string
    {
        return $this->secondName;
    }
}