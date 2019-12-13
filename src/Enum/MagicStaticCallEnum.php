<?php
declare(strict_types=1);
/**
 * @author Alexander Dmitriev <alex@aadmitriev.ru>
 * @date 13.12.19
 */

namespace Enum;

/**
 * Trait MagicStaticCallEnum
 * @package Enum
 */
trait MagicStaticCallEnum
{
    /**
     * @param string $name
     * @param array $arguments
     * @return self|null
     */
    public static function __callStatic($name, $arguments)
    {
        $convertedName = strtolower(preg_replace('/[A-Z]/', '_\\0', lcfirst($name)));

        return static::getInstances()[$convertedName] ?? static::getInstances()[strtoupper($convertedName)] ?? null;
    }

    /**
     * @return array
     */
    abstract public static function getInstances(): array;
}
