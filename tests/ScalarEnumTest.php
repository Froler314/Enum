<?php

use Enum\ScalarEnum;

class TestScalarEnum extends ScalarEnum {
    const CONSTANT_1 = 1;
    const CONSTANT_2 = 2;
}

class ScalarEnumTest extends \PHPUnit_Framework_TestCase
{
    public function testGetKeys()
    {
        self::assertEquals('CONSTANT_1', TestScalarEnum::getKeys()[0]);
        self::assertEquals('CONSTANT_2', TestScalarEnum::getKeys()[1]);
    }

    public function testGetValues()
    {
        self::assertEquals(1, TestScalarEnum::getValues()[0]);
        self::assertEquals(2, TestScalarEnum::getValues()[1]);
    }

    public function testToArray()
    {
        self::assertEquals(1, TestScalarEnum::toArray()['CONSTANT_1']);
        self::assertEquals(2, TestScalarEnum::toArray()['CONSTANT_2']);
    }
}