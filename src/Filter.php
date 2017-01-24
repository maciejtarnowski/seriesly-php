<?php

namespace Seriesly;

use Seriesly\Query\Query;

class Filter implements Query
{
    /**
     * @var string
     */
    private $pointer;

    /**
     * @va string
     */
    private $value;

    /**
     * Filter constructor.
     * @param string $pointer
     * @param $value
     */
    public function __construct($pointer, $value)
    {
        $this->pointer = $pointer;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getPointer()
    {
        return $this->pointer;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getQueryString()
    {
        return http_build_query(['f' => $this->getPointer(), 'fv' => $this->getValue()]);
    }
}
