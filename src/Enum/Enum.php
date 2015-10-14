<?php
/**
 * @author Alexander Dmitriev <alex@aadmitriev.ru>
 * @date 14.10.15
 */

namespace Enum;

/**
 * Class Enum
 * @package Enum
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
        $className = get_called_class();

        if (empty(self::$initedClassNames[$className])) {
            static::initKeys();
            self::$initedClassNames[$className] = true;
        }
    }

    /**
     * @inheritdoc
     */
    public static function addEnumItem(Enum $instance)
    {
        $className = get_called_class();

        if (!isset(self::$instances[$className])) {
            self::$instances[$className] = [];
        }

        self::$instances[$className][$instance->getId()] = $instance;
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

        $className = get_called_class();
        if (!isset(self::$instances[$className])) {
            throw new EnumException("No instances was initialized for Enum class '{$className}'");
        }

        return self::$instances[$className];
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

        $className = get_called_class();
        if (!isset(self::$instances[$className][$id])) {
            throw new EnumException("No Enum instance with id '{$id}' for Enum class '{$className}'");
        }

        return self::$instances[$className][$id];
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