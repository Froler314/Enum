<?php

declare(strict_types=1);

namespace Enum;

/**
 * Trait MagicStaticCallEnum
 * @package Enum
 * @author Alexander Dmitriev <alex@aadmitriev.ru>
 * @date 13.12.19
 */
trait MagicStaticCallEnum
{
    public static function __callStatic(string $name, array $arguments): ?static
    {
        $convertedName = strtolower(preg_replace('/[A-Z]/', '_\\0', lcfirst($name)));

        return static::getInstances()[$convertedName] ?? static::getInstances()[strtoupper($convertedName)] ?? null;
    }

    abstract public static function getInstances(): array;
}
