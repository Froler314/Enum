<?php

use Enum\ModelEnum;

class ModelEnumTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        self::assertEquals(1, (string)TestModelEnum::getInstance(1));
        self::assertEquals(2, (string)TestModelEnum::getInstance(2));
    }
}

class TestModelEnum extends ModelEnum {
    public static function initKeys()
    {
        self::addEnumItem(new self(1));
        self::addEnumItem(new self(2));
    }
}
