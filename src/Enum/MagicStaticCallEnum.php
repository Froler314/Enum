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
    /**
     * @throws EnumException
     */
    public static function __callStatic(string $name, array $arguments): static
    {
        $convertedName = strtolower(preg_replace('/[A-Z]/', '_\\0', lcfirst($name)));

        return static::getInstances()[$convertedName]
            ?? static::getInstances()[strtoupper($convertedName)]
            ?? static::getInstances()[$name]
            ?? throw new EnumException(sprintf('No such Enum instance for Enum class "%s"', static::class));
    }

    abstract public static function getInstances(): array;
}
