<?php

namespace Seriesly;

class TimeRange
{
    /**
     * @var \DateTimeInterface
     */
    private $from;

    /**
     * @var \DateTimeInterface
     */
    private $to;

    /**
     * TimeRange constructor.
     * @param \DateTimeInterface $from
     * @param \DateTimeInterface $to
     */
    public function __construct(\DateTimeInterface $from = null, \DateTimeInterface $to = null)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getFrom()
    {
        return $this->from;
    }

    public function getFromISO()
    {
        if ($this->from !== null) {
            return $this->from->format(DATE_ISO8601);
        }
        return null;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getTo()
    {
        return $this->to;
    }

    public function getToISO()
    {
        if ($this->to !== null) {
            return $this->to->format(DATE_ISO8601);
        }
        return null;
    }
}
