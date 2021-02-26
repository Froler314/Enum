<?php

declare(strict_types=1);

use Enum\Enum;
use Enum\MagicStaticCallEnum;
use PHPUnit\Framework\TestCase;

/**
 * @method static self valueA()
 * @method static self valueB()
 */
class TestEnum extends Enum {
    use MagicStaticCallEnum;

    public const CONSTANT_A = 'value_a';
    public const CONSTANT_B = 'value_b';
}

class EnumTest extends TestCase
{
    public function testGetInstances(): void
    {
        self::assertInstanceOf(TestEnum::class, TestEnum::getInstances()[TestEnum::CONSTANT_A]);
        self::assertInstanceOf(TestEnum::class, TestEnum::getInstances()[TestEnum::CONSTANT_B]);
    }

    public function testGetInstance(): void
    {
        self::assertInstanceOf(TestEnum::class, TestEnum::getInstance(TestEnum::CONSTANT_A));
        self::assertInstanceOf(TestEnum::class, TestEnum::getInstance('value_b'));
    }

    public function testGetValues(): void
    {
        self::assertEquals(TestEnum::CONSTANT_A, TestEnum::getValues()[0]);
        self::assertEquals(TestEnum::CONSTANT_B, TestEnum::getValues()[1]);
    }

    public function testToHashMap(): void
    {
        self::assertEquals(TestEnum::CONSTANT_A, TestEnum::toHashMap()[TestEnum::CONSTANT_A]);
        self::assertEquals(TestEnum::CONSTANT_B, TestEnum::toHashMap()[TestEnum::CONSTANT_B]);
    }

    public function testGetValue(): void
    {
        self::assertEquals(TestEnum::CONSTANT_A, TestEnum::getInstance(TestEnum::CONSTANT_A)->getValue());
        self::assertEquals(TestEnum::CONSTANT_B, TestEnum::getInstance(TestEnum::CONSTANT_B)->getValue());
    }

    public function testEquals(): void
    {
        self::assertTrue(TestEnum::getInstance(TestEnum::CONSTANT_A)->equals(TestEnum::getInstance(TestEnum::CONSTANT_A)));
        self::assertFalse(TestEnum::getInstance(TestEnum::CONSTANT_A)->equals(TestEnum::getInstance(TestEnum::CONSTANT_B)));
    }

    public function testToString(): void
    {
        self::assertEquals(TestEnum::CONSTANT_A, TestEnum::getInstance(TestEnum::CONSTANT_A));
    }

    public function testMagicStaticCall(): void
    {
        self::assertEquals(TestEnum::CONSTANT_A, TestEnum::valueA());
        self::assertEquals(TestEnum::CONSTANT_B, TestEnum::valueB());
    }
}
