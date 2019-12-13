<?php

use Enum\Enum;
use Enum\MagicStaticCallEnum;

/**
 * @method static self valueA()
 * @method static self valueB()
 */
class TestEnum extends Enum {
    use MagicStaticCallEnum;

    const CONSTANT_A = 'value_a';
    const CONSTANT_B = 'value_b';
}

class EnumTest extends \PHPUnit_Framework_TestCase
{
    public function testGetInstances()
    {
        self::assertInstanceOf(TestEnum::class, TestEnum::getInstances()[TestEnum::CONSTANT_A]);
        self::assertInstanceOf(TestEnum::class, TestEnum::getInstances()[TestEnum::CONSTANT_B]);
    }

    public function testGetInstance()
    {
        self::assertInstanceOf(TestEnum::class, TestEnum::getInstance(TestEnum::CONSTANT_A));
        self::assertInstanceOf(TestEnum::class, TestEnum::getInstance('value_b'));
    }

    public function testGetValues()
    {
        self::assertEquals(TestEnum::CONSTANT_A, TestEnum::getValues()[0]);
        self::assertEquals(TestEnum::CONSTANT_B, TestEnum::getValues()[1]);
    }

    public function testToHashMap()
    {
        self::assertEquals(TestEnum::CONSTANT_A, TestEnum::toHashMap()[TestEnum::CONSTANT_A]);
        self::assertEquals(TestEnum::CONSTANT_B, TestEnum::toHashMap()[TestEnum::CONSTANT_B]);
    }

    public function testGetValue()
    {
        self::assertEquals(TestEnum::CONSTANT_A, TestEnum::getInstance(TestEnum::CONSTANT_A)->getValue());
        self::assertEquals(TestEnum::CONSTANT_B, TestEnum::getInstance(TestEnum::CONSTANT_B)->getValue());
    }

    public function testEquals()
    {
        self::assertTrue(TestEnum::getInstance(TestEnum::CONSTANT_A)->equals(TestEnum::getInstance(TestEnum::CONSTANT_A)));
        self::assertFalse(TestEnum::getInstance(TestEnum::CONSTANT_A)->equals(TestEnum::getInstance(TestEnum::CONSTANT_B)));
    }

    public function testToString()
    {
        self::assertEquals(TestEnum::CONSTANT_A, TestEnum::getInstance(TestEnum::CONSTANT_A));
    }

    public function testMagicStaticCall()
    {
        self::assertEquals(TestEnum::CONSTANT_A, TestEnum::valueA());
        self::assertEquals(TestEnum::CONSTANT_B, TestEnum::valueB());
    }
}