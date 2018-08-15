<?php

use Enum\Enum;

class TestEnum extends Enum {
    const CONSTANT_1 = 'value1';
    const CONSTANT_2 = 'value2';
}

class EnumTest extends \PHPUnit_Framework_TestCase
{
    public function testGetInstances()
    {
        self::assertInstanceOf(TestEnum::class, TestEnum::getInstances()[TestEnum::CONSTANT_1]);
        self::assertInstanceOf(TestEnum::class, TestEnum::getInstances()[TestEnum::CONSTANT_2]);
    }

    public function testGetInstance()
    {
        self::assertInstanceOf(TestEnum::class, TestEnum::getInstance(TestEnum::CONSTANT_1));
        self::assertInstanceOf(TestEnum::class, TestEnum::getInstance('value2'));
    }

    public function testGetValues()
    {
        self::assertEquals(TestEnum::CONSTANT_1, TestEnum::getValues()[0]);
        self::assertEquals(TestEnum::CONSTANT_2, TestEnum::getValues()[1]);
    }

    public function testToHashMap()
    {
        self::assertEquals(TestEnum::CONSTANT_1, TestEnum::toHashMap()[TestEnum::CONSTANT_1]);
        self::assertEquals(TestEnum::CONSTANT_2, TestEnum::toHashMap()[TestEnum::CONSTANT_2]);
    }

    public function testGetValue()
    {
        self::assertEquals(TestEnum::CONSTANT_1, TestEnum::getInstance(TestEnum::CONSTANT_1)->getValue());
        self::assertEquals(TestEnum::CONSTANT_2, TestEnum::getInstance(TestEnum::CONSTANT_2)->getValue());
    }

    public function testEquals()
    {
        self::assertTrue(TestEnum::getInstance(TestEnum::CONSTANT_1)->equals(TestEnum::getInstance(TestEnum::CONSTANT_1)));
        self::assertFalse(TestEnum::getInstance(TestEnum::CONSTANT_1)->equals(TestEnum::getInstance(TestEnum::CONSTANT_2)));
    }

    public function testToString()
    {
        self::assertEquals(TestEnum::CONSTANT_1, TestEnum::getInstance(TestEnum::CONSTANT_1));
    }
}