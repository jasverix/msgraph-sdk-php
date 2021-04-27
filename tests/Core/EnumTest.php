<?php

use Microsoft\Graph\Core\Enum;
use PHPUnit\Framework\TestCase;

class TestEnum extends Enum {

    const TEST = "0";
    const TEST1 = "1";
}

class EnumTest extends TestCase
{  
    public function testInvalidEnum()
    {
        $this->expectException(Microsoft\Graph\Exception\GraphException::class);

        $enum = new TestEnum("test");
    }

    public function testValidEnum()
    {
        $enum = new TestEnum("0");

        $this->assertFalse($enum->is("1"));
        $this->assertEquals("0", $enum->value());
    }

    public function testEnumHasInvalidValueReturnsFalse()
    {
        $enum = new TestEnum("1");
        $this->assertFalse($enum->has("2"));
    }

    public function testEnumHasValidValueReturnsTrue()
    {
        $enum = new TestEnum("1");
        $this->assertTrue($enum->has("1"));
    }

    public function testEnumToArray()
    {
        $enum = new TestEnum("0");
        $testEnumConstants = $enum->toArray();
        $this->assertIsArray($testEnumConstants);
        $expected = array (
            "TEST" => "0",
            "TEST1" => "1"
        );
        $this->assertEquals($expected, $testEnumConstants);
    }
}