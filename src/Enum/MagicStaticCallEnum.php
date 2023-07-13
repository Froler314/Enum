<?php

declare(strict_types=1);

namespace Enum;

use function constant;
use function defined;

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
    public static function __callStatic(string $name, array $arguments): self
    {
        $convertedName = strtolower(preg_replace('/[A-Z]/', '_\\0', lcfirst($name)));

        $instance = static::getInstances()[$convertedName]
            ?? static::getInstances()[strtoupper($convertedName)]
            ?? static::getInstances()[$name]
            ?? null;

        if (defined(static::class . '::' . strtoupper($convertedName))) {
            $instance = static::getInstance(constant(static::class . '::' . strtoupper($convertedName)));
        }

        if ($instance === null) {
            throw new EnumException(sprintf('No such Enum instance for Enum class "%s"', static::class));
        }

        return $instance;
    }

    abstract public static function getInstances(): array;

    abstract public static function getInstance($value);
}
