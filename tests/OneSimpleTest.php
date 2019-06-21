<?php


use PHPUnit\Framework\TestCase;

class OneSimpleTest extends TestCase
{
    public function testSum()
    {
        $this->assertEquals(2, 1+1);
    }
}
