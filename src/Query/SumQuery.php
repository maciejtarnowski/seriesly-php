<?php

namespace Seriesly\Query;

class SumQuery extends AggregateQuery
{
    /**
     * @return string
     */
    protected function getReducer()
    {
        return 'sum';
    }
}
