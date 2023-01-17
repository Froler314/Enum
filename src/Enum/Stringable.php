<?php
declare(strict_types=1);

namespace Enum;

// php8
if (class_exists('Stringable')) {
    interface Stringable extends \Stringable
    {
    }
} else {
    interface Stringable
    {
        public function __toString(): string;
    }
}
