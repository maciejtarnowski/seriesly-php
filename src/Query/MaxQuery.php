<?php

namespace Seriesly\Query;

class MaxQuery extends AggregateQuery
{

    /**
     * @return string
     */
    protected function getReducer()
    {
        return 'max';
    }
}
