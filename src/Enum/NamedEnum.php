<?php
/**
 * @author Alexander Dmitriev <alex@aadmitriev.ru>
 * @date 14.10.15
 */

namespace Enum;

/**
 * Class NamedEnum
 * @package Enum
 */
abstract class NamedEnum extends AbstractEnum
{

    /**
     * @var string
     */
    private $name;

    /**
     * @param mixed $id
     * @param string $name
     */
    protected function __construct($id, $name)
    {
        $this->name = $name;

        parent::__construct($id);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

}
