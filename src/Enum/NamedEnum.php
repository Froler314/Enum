<?php

declare(strict_types=1);

namespace Enum;

/**
 * Class NamedEnum
 * @package Enum
 * @author Alexander Dmitriev <alex@aadmitriev.ru>
 * @date 15.08.18
 */
abstract class NamedEnum extends Enum
{
    private string $name;

    protected function __construct(mixed $value, string $name)
    {
        $this->name = $name;

        parent::__construct($value);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
