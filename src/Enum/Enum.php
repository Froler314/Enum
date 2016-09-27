<?php
/**
 * @author Alexander Dmitriev <alex@aadmitriev.ru>
 * @date 14.10.15
 */

namespace Enum;

/**
 * Class Enum
 * @package Enum
 * @deprecated deleted in v1.0.0
 */
abstract class Enum implements EnumInterface
{

    /**
     * @var Enum[][]
     */
    private static $instances = [];
    /**
     * @var array
     */
    private static $initedClassNames = [];
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @return void
     */
    private static function initKeysIfNotInited()
    {
        if (empty(self::$initedClassNames[static::class])) {
            static::initKeys();
            self::$initedClassNames[static::class] = true;
        }
    }

    /**
     * @inheritdoc
     */
    public static function addEnumItem(Enum $instance)
    {
        if (!isset(self::$instances[static::class])) {
            self::$instances[static::class] = [];
        }

        self::$instances[static::class][$instance->getId()] = $instance;
    }

    /**
     * Получение всех объектов Enum типа того класса, от которого вызван метод с использованием их ID (ключей) в качестве ключей массива
     *
     * @return static[]
     * @throws EnumException
     */
    public static function getInstances()
    {
        self::initKeysIfNotInited();

        if (!isset(self::$instances[static::class])) {
            throw new EnumException(sprintf('No instances was initialized for Enum class "%s"', static::class));
        }

        return self::$instances[static::class];
    }

    /**
     * Получение конкретного объекта Enum типа того класса, от которого вызван метод, по его ID (ключу)
     *
     * @param mixed $id
     * @return static
     * @throws EnumException
     */
    public static function getInstance($id)
    {

        self::initKeysIfNotInited();

        if (!isset(self::$instances[static::class][$id])) {
            throw new EnumException(sprintf('No Enum instance with id "%s" for Enum class "%s"', $id, static::class));
        }

        return self::$instances[static::class][$id];
    }

    /**
     * @param mixed $id
     */
    protected function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function equals(Enum $item)
    {
        return ($item instanceof self) && $item->getId() == $this->getId();
    }

}