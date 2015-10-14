<?php
/**
 * @author Alexander Dmitriev <alex@aadmitriev.ru>
 * @date 14.10.15
 */

namespace Enum;

/**
 * Interface EnumInterface
 * @package Enum
 */
interface EnumInterface
{

    /**
     * Метод должен содержать инициализацию всех Enum объектов заданного типа путём последовательного их добавления через метод addEnumItem
     * Пример:
     *
     *      public static function initKeys()
     *      {
     *          self::addEnumItem(new SomeEnumClass(0, 'foo'));
     *          self::addEnumItem(new SomeEnumClass(1, 'bar'));
     *          self::addEnumItem(new SomeEnumClass(2, 'foo_bar'));
     *      }
     *
     * @return void
     */
    public static function initKeys();

    /**
     * Метод добавляет объект Enum в пул Enum'ов данного типа
     * Пример:
     *
     *      self::addEnumItem(new SomeEnumClass('foo', 'bar'));
     *
     * @param Enum $enumItem
     * @return void
     */
    public static function addEnumItem(Enum $enumItem);

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param Enum $enumItem
     * @return mixed
     */
    public function equals(Enum $enumItem);

}