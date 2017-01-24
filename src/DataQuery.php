<?php

namespace Seriesly;

use Seriesly\Query\AggregateQuery;
use Seriesly\Query\Query;

class DataQuery implements Query
{
    /**
     * @var TimeRange
     */
    private $timeRange;

    /**
     * @var Grouping
     */
    private $group;

    /**
     * @var AggregateQuery[]
     */
    private $queries = [];

    /**
     * @var Filter[]
     */
    private $filters = [];

    /**
     * DataQuery constructor.
     * @param TimeRange $timeRange
     * @param Grouping $group
     * @param AggregateQuery[] $queries
     * @param array $filters
     */
    public function __construct(
        TimeRange $timeRange,
        Grouping $group,
        array $queries,
        array $filters
    ) {
        $this->timeRange = $timeRange;
        $this->group = $group;
        $this->queries = $queries;
        $this->filters = $filters;
    }

    /**
     * @return string
     */
    public function getQueryString()
    {
        return join('&', $this->getData());
    }

    /**
     * @return array
     */
    public function getResultKeys()
    {
        return array_keys($this->queries);
    }

    /**
     * @return string[]
     */
    private function getData()
    {
        $data = [];

        if ($this->timeRange->getFromISO() !== null) {
            $data[] = http_build_query(['from' => $this->timeRange->getFromISO()]);
        }
        if ($this->timeRange->getToISO() !== null) {
            $data[] = http_build_query(['to' => $this->timeRange->getToISO()]);
        }

        $data[] = http_build_query(['group' => $this->group->getValue()]);

        foreach ($this->queries as $query) {
            $data[] = $query->getQueryString();
        }

        foreach ($this->filters as $filter) {
            $data[] = $filter->getQueryString();
        }

        return $data;
    }
}
