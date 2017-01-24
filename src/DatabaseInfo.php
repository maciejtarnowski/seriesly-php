<?php

namespace Seriesly;

class DatabaseInfo
{
    /**
     * @var int
     */
    private $deletedCount = 0;

    /**
     * @var int
     */
    private $docCount = 0;

    /**
     * @var int
     */
    private $headerPos = 0;

    /**
     * @var int
     */
    private $lastSeq = 0;

    /**
     * @var int
     */
    private $spaceUsed = 0;

    /**
     * DatabaseInfo constructor.
     * @param int $deletedCount
     * @param int $docCount
     * @param int $headerPos
     * @param int $lastSeq
     * @param int $spaceUsed
     */
    public function __construct($deletedCount, $docCount, $headerPos, $lastSeq, $spaceUsed)
    {
        $this->deletedCount = $deletedCount;
        $this->docCount = $docCount;
        $this->headerPos = $headerPos;
        $this->lastSeq = $lastSeq;
        $this->spaceUsed = $spaceUsed;
    }

    /**
     * @return int
     */
    public function getDeletedCount()
    {
        return $this->deletedCount;
    }

    /**
     * @return int
     */
    public function getDocCount()
    {
        return $this->docCount;
    }

    /**
     * @return int
     */
    public function getHeaderPos()
    {
        return $this->headerPos;
    }

    /**
     * @return int
     */
    public function getLastSeq()
    {
        return $this->lastSeq;
    }

    /**
     * @return int
     */
    public function getSpaceUsed()
    {
        return $this->spaceUsed;
    }
}
