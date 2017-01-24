<?php

namespace Seriesly\Query;

class CountQuery extends AggregateQuery
{
    /**
     * @return string
     */
    protected function getReducer()
    {
        return 'count';
    }
}
