<?php

namespace Seriesly;

class Grouping
{
    const SECOND = 1000;
    const MINUTE = 60000;
    const HOUR = 3600000;
    const DAY = 86400000;

    /**
     * @var int
     */
    private $value;

    /**
     * Grouping constructor.
     * @param int $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }
}
