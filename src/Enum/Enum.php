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
abstract class Enum extends AbstractEnum
{

    /**
     * @var array
     */
    static private $instancesByValues = [];
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @inheritdoc
     */
    static public function initKeys()
    {
        foreach ((new \ReflectionClass(static::class))->getConstants() as $constantName => $constantValue) {
            self::addEnumItem(new static($constantName, $constantValue));
        }
    }

    /**
     * @inheritdoc
     */
    static public function addEnumItem(EnumInterface $instance)
    {
        if (!isset(self::$instancesByValues[static::class])) {
            self::$instancesByValues[static::class] = [];
        }

        if ($instance instanceof Enum) {
            self::$instancesByValues[static::class][$instance->getValue()] = $instance;
        }

        parent::addEnumItem($instance);
    }

    /**
     * @inheritdoc
     */
    static public function getInstance($idOrValue)
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
    static public function getValues()
    {
        return array_values(self::toArray());
    }

    /**
     * @return array
     * @throws EnumException
     */
    static public function toArray()
    {
        $array = [];
        foreach (self::getInstances() as $instance) {
            $array[$instance->getId()] = $instance->value;
        }

        return $array;
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
        return (string)$this->getValue();
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

}
