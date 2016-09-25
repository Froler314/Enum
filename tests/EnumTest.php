<?php

use Enum\Enum;

class EnumTest extends \PHPUnit_Framework_TestCase
{
    public function testGetKeys()
    {
        self::assertEquals('CONSTANT_1', TestEnum::getKeys()[0]);
        self::assertEquals('CONSTANT_2', TestEnum::getKeys()[1]);
    }

    public function testGetValues()
    {
        self::assertEquals(1, TestEnum::getValues()[0]);
        self::assertEquals(2, TestEnum::getValues()[1]);
    }

    public function testToArray()
    {
        self::assertEquals(1, TestEnum::toArray()['CONSTANT_1']);
        self::assertEquals(2, TestEnum::toArray()['CONSTANT_2']);
    }

    public function testGetInstance()
    {
        self::assertInstanceOf(TestEnum::class, TestEnum::getInstance(TestEnum::CONSTANT_1));
        self::assertInstanceOf(TestEnum::class, TestEnum::getInstance('CONSTANT_2'));
    }
}

class TestEnum extends Enum {
    const CONSTANT_1 = 1;
    const CONSTANT_2 = 2;
}
