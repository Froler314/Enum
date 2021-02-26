<?php

declare(strict_types=1);

namespace Enum;

use ReflectionClass;
use Stringable;

/**
 * Class Enum
 * @package Enum
 * @author Alexander Dmitriev <alex@aadmitriev.ru>
 * @date 15.08.18
 */
abstract class Enum implements Stringable
{
    /**
     * @var Enum[][]
     */
    private static array $instances = [];

    private mixed $value;

    /**
     * Return enum objects as hash map with value as its indexes
     *
     * @return static[]
     */
    public static function getInstances(): array
    {
        self::initKeysIfNotInited();

        return self::$instances[static::class];
    }

    /**
     * Return enum object by its value (Useful for type casting)
     *
     * @param mixed $value
     * @return static
     * @throws EnumException
     */
    public static function getInstance(mixed $value): static
    {
        $instances = self::getInstances();

        if (empty($instances[$value])) {
            throw new EnumException(
                sprintf('No Enum instance with value "%s" for Enum class "%s"', $value, static::class)
            );
        }

        return $instances[$value];
    }

    /**
     * Return values as list (["value1", "value2"])
     *
     * @return array
     */
    public static function getValues(): array
    {
        return array_values(
            array_map(
                function (Enum $enum) {
                    return $enum->getValue();
                },
                self::getInstances()
            )
        );
    }

    /**
     * Return values as hash map ({"value1": "value1", "value2": "value2"})
     *
     * @return array
     */
    public static function toHashMap(): array
    {
        return array_combine(self::getValues(), self::getValues());
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function equals(Enum $item): bool
    {
        return $item instanceof static && $item->value === $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    protected function __construct(mixed $value)
    {
        $this->value = $value;
    }

    private static function initKeysIfNotInited(): void
    {
        if (empty(self::$instances[static::class])) {
            self::$instances[static::class] = [];

            foreach ((new ReflectionClass(static::class))->getConstants() as $constantValue) {
                self::$instances[static::class][$constantValue] = new static($constantValue);
            }
        }
    }
}
