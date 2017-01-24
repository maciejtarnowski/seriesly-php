<?php

namespace Seriesly\Query;

class AnyQuery extends AggregateQuery
{
    /**
     * @return string
     */
    protected function getReducer()
    {
        return 'any';
    }
}
