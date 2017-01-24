<?php

namespace Seriesly\Query;

class AvgQuery extends AggregateQuery
{
    /**
     * @return string
     */
    protected function getReducer()
    {
        return 'avg';
    }
}
