<?php
/**
 * @author Alexander Dmitriev <alex@aadmitriev.ru>
 * @date 27.09.16
 */

namespace Enum;

/**
 * Class ModelEnum
 * @package Enum
 */
abstract class ModelEnum extends AbstractEnum
{
    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getId();
    }
}