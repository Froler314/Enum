<?php

use Enum\BaseEnum;

class TestBaseEnum extends BaseEnum {
    const CONSTANT_1 = 1;
    const CONSTANT_2 = 2;
}

class ScalarEnumTest extends \PHPUnit_Framework_TestCase
{
    public function testGetKeys()
    {
        self::assertEquals('CONSTANT_1', TestBaseEnum::getKeys()[0]);
        self::assertEquals('CONSTANT_2', TestBaseEnum::getKeys()[1]);
    }

    public function testGetValues()
    {
        self::assertEquals(1, TestBaseEnum::getValues()[0]);
        self::assertEquals(2, TestBaseEnum::getValues()[1]);
    }

    public function testToArray()
    {
        self::assertEquals(1, TestBaseEnum::toArray()['CONSTANT_1']);
        self::assertEquals(2, TestBaseEnum::toArray()['CONSTANT_2']);
    }
}