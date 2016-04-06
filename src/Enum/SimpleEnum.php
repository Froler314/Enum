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
abstract class SimpleEnum extends Enum
{
    /**
     * @inheritdoc
     */
    final public static function initKeys()
    {
        foreach ((new \ReflectionClass(get_called_class()))->getConstants() as $constant) {
            self::addEnumItem(new static($constant));
        }
    }
}