<?php
/**
 * @author Alexander Dmitriev <alex@aadmitriev.ru>
 * @date 06.04.16
 */

namespace Enum;

/**
 * Class SimpleEnum
 * @package Enum
 * @deprecated deleted in v1.0.0
 */
abstract class BaseEnum extends Enum
{
    /**
     * @var mixed
     */
    protected $value;
    /**
     * @var array
     */
    private static $instancesByValues = [];

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
     * @inheritdoc
     */
    public static function addEnumItem(Enum $instance)
    {
        if (!isset(self::$instancesByValues[static::class])) {
            self::$instancesByValues[static::class] = [];
        }

        if ($instance instanceof BaseEnum) {
            self::$instancesByValues[static::class][$instance->getValue()] = $instance;
        }

        parent::addEnumItem($instance);
    }

    /**
     * @inheritdoc
     */
    public static function getInstance($idOrValue)
    {
        try {
            return parent::getInstance($idOrValue);
        } catch (EnumException $e) {
            if (isset(self::$instancesByValues[static::class][$idOrValue])) {
                return self::$instancesByValues[static::class][$idOrValue];
            }

            throw $e;
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

    /**
     * @return mixed
     */
    public function __toString()
    {
        return (string) $this->getValue();
    }
}