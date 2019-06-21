<?php


namespace Provectus\Tram\Tests;


use PHPUnit\Framework\TestCase;
use Provectus\Tram\Tram;

class TramTest extends TestCase
{
    public function testCreateModel()
    {
        $tram = new Tram();
        $this->assertTrue(is_object($tram));
    }
}
