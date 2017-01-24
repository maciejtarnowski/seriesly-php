<?php

namespace Seriesly\Query;

class MinQuery extends AggregateQuery
{

    /**
     * @return string
     */
    protected function getReducer()
    {
        return 'min';
    }
}
