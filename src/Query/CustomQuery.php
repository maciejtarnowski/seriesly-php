<?php

namespace Seriesly\Query;

class CustomQuery extends AggregateQuery
{
    /**
     * @var string
     */
    private $reducer;

    /**
     * CustomQuery constructor.
     * @param string $pointer
     * @param string $reducer
     */
    public function __construct($pointer, $reducer)
    {
        parent::__construct($pointer);
        $this->reducer = $reducer;
    }

    /**
     * @return string
     */
    protected function getReducer()
    {
        return $this->reducer;
    }
}
