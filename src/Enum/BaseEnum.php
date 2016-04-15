<?php
/**
 * @author Alexander Dmitriev <alex@aadmitriev.ru>
 * @date 06.04.16
 */

namespace Enum;

/**
 * Class SimpleEnum
 * @package Enum
 */
abstract class BaseEnum extends Enum
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @inheritdoc
     */
    final public static function initKeys()
    {
        foreach ((new \ReflectionClass(static::class))->getConstants() as $constantName => $constantValue) {
            self::addEnumItem(new static($constantName, $constantValue));
        }
    }

    /**
     * @return array
     */
    public static function getKeys()
    {
        return array_keys(self::toArray());
    }

    /**
     * @return array
     */
    public static function getValues()
    {
        return array_values(self::toArray());
    }

    /**
     * @return array
     * @throws EnumException
     */
    public static function toArray()
    {
        $array = [];
        foreach (self::getInstances() as $instance) {
            $array[$instance->id] = $instance->value;
        }

        return $array;
    }

    /**
     * ScalarEnum constructor.
     * @param mixed $id
     * @param mixed $value
     */
    protected function __construct($id, $value)
    {
        $this->value = $value;

        parent::__construct($id);
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}