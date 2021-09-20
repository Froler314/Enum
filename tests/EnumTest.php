<?php

declare(strict_types=1);

use Enum\Enum;
use Enum\EnumException;
use Enum\MagicStaticCallEnum;
use PHPUnit\Framework\TestCase;

/**
 * @method static self valueA()
 * @method static self valueB()
 * @method static self capsValue()
 * @method static self camelCaseValue()
 * @method static self unknownValue()
 */
class TestEnum extends Enum {
    use MagicStaticCallEnum;

    public const CONSTANT_A = 'value_a';
    public const CONSTANT_B = 'value_b';
    public const CONSTANT_C = 'CAPS_VALUE';
    public const CONSTANT_D = 'camelCaseValue';
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
        self::assertEquals(TestEnum::CONSTANT_A, TestEnum::valueA()->getValue());
        self::assertEquals(TestEnum::CONSTANT_B, TestEnum::valueB()->getValue());
        self::assertEquals(TestEnum::CONSTANT_C, TestEnum::capsValue()->getValue());
        self::assertEquals(TestEnum::CONSTANT_D, TestEnum::camelCaseValue()->getValue());

        $this->expectException(EnumException::class);
        TestEnum::unknownValue();
    }
}
