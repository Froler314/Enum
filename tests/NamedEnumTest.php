<?php

use Enum\NamedEnum;

class NamedEnumTest extends \PHPUnit_Framework_TestCase
{
    public function testGetInstance()
    {
        self::assertInstanceOf(TestNamedEnum::class, TestNamedEnum::getInstance(1));
        self::assertEquals('one', TestNamedEnum::getInstance(1)->getName());
        self::assertInstanceOf(TestNamedEnum::class, TestNamedEnum::getInstance(2));
        self::assertEquals('two', TestNamedEnum::getInstance(2)->getName());
    }

    public function testGetInstances()
    {
        self::assertCount(2, TestNamedEnum::getInstances());
        self::assertEquals('one', TestNamedEnum::getInstances()[1]->getName());
        self::assertEquals('two', TestNamedEnum::getInstances()[2]->getName());
    }
}

class TestNamedEnum extends NamedEnum {
    public static function initKeys()
    {
        self::addEnumItem(new self(1, 'one'));
        self::addEnumItem(new self(2, 'two'));
    }
}
