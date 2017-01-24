<?php

namespace Seriesly\Query;

abstract class AggregateQuery implements Query
{
    /**
     * @var string
     */
    private $pointer;

    /**
     * AggregateQuery constructor.
     * @param string $pointer
     */
    public function __construct($pointer)
    {
        $this->pointer = $pointer;
    }

    /**
     * @return string
     */
    public function getQueryString()
    {
        return http_build_query($this->getData());
    }

    /**
     * @return string
     */
    public function getPointer()
    {
        return $this->pointer;
    }

    /**
     * @return string
     */
    abstract protected function getReducer();

    /**
     * @return array
     */
    private function getData()
    {
        return ['ptr' => $this->getPointer(), 'reducer' => $this->getReducer()];
    }
}
