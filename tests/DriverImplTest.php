<?php

namespace Provectus\Tram\Tests;

use PHPUnit\Framework\TestCase;
use Provectus\Tram\DriverImpl;
use Provectus\Tram\WrongDriverName;

class DriverImplTest extends TestCase
{
    /**
     * @var DriverImpl
     */
    private $driver;

    /** @dataProvider wrongNamesProvider */
    public function testWrongConstruct($wrongName, $wrongSecondName, $wrongLastName)
    {
        $this->expectException(WrongDriverName::class);
        new DriverImpl($wrongName, $wrongSecondName, $wrongLastName);
    }

    public function testGetFullName()
    {
        $this->assertSame('John Dow Smith', $this->driver->getFullName());
    }

    public function testGetLastName()
    {
        $this->assertSame('Smith', $this->driver->getLastName());
    }

    public function testGetFirstName()
    {
        $this->assertSame('John', $this->driver->getFirstName());
    }

    public function testGetSecondName()
    {
        $this->assertSame('Dow', $this->driver->getSecondName());
    }

    public function wrongNamesProvider()
    {
        return [
            'empty all names' => ['', '', ''],
            'only second name' => ['', 'John', ''],
            'only first name' => ['Dow', '', ''],
            'wrong both name' => ['32dff', 'mусцф9=', ''],
            'wrong second name' => ['John', '3fecfg34g', ''],
            'wrong first name' => ['esvs=reg', 'Грибоедов', ''],
            'wrong last name' => ['Сергей', 'Есенин', '+4в4е']
        ];
    }

    protected function setUp(): void
    {
        $this->driver = new DriverImpl('John', 'Dow', 'Smith');
    }
}
