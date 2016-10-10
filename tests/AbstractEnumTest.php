<?php

use Enum\AbstractEnum;

class AbstractEnumTest extends \PHPUnit_Framework_TestCase
{
    public function testGetInstance()
    {
        self::assertInstanceOf(TestAbstractEnum::class, TestAbstractEnum::getInstance(1));
        self::assertEquals(1, TestAbstractEnum::getInstance(1)->getId());
        self::assertInstanceOf(TestAbstractEnum::class, TestAbstractEnum::getInstance(2));
        self::assertEquals(2, TestAbstractEnum::getInstance(2)->getId());
    }

    public function testGetInstances()
    {
        self::assertCount(2, TestAbstractEnum::getInstances());
        self::assertEquals(1, TestAbstractEnum::getInstances()[1]->getId());
        self::assertEquals(2, TestAbstractEnum::getInstances()[2]->getId());
    }

    public function testGetKeys()
    {
        self::assertCount(2, TestAbstractEnum::getKeys());
        self::assertEquals(1, TestAbstractEnum::getKeys()[0]);
        self::assertEquals(2, TestAbstractEnum::getKeys()[1]);
    }
}

class TestAbstractEnum extends AbstractEnum {
    public static function initKeys()
    {
        self::addEnumItem(new self(1));
        self::addEnumItem(new self(2));
    }
}
