<?php
/**
 * @author Alexander Dmitriev <alex@aadmitriev.ru>
 * @date 15.08.18
 */

namespace Enum;

/**
 * Class NamedEnum
 * @package Enum
 */
abstract class NamedEnum extends Enum
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param mixed $value
     * @param string $name
     */
    protected function __construct($value, string $name)
    {
        $this->name = $name;

        parent::__construct($value);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }
}