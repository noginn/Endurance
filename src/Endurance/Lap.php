<?php

namespace Endurance;

class Lap
{
    public $distance;

    /**
     * The start index of the Activity points array
     *
     * @var int
     */
    protected $start;

    /**
     * The end index of the Activity points array
     *
     * @var int
     */
    protected $end;

    public function __construct($start = 0, $end = 0)
    {
        $this->setStart($start);
        $this->setEnd($end);
    }

    public function setStart($start)
    {
        $this->start = (int) $start;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setEnd($end)
    {
        $this->end = (int) $end;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function setDistance($distance)
    {
        $this->distance = (float) $distance;
    }

    public function getDistance()
    {
        return $this->distance;
    }

    public function filterPoints(array $points)
    {
        return array_slice($points, $this->getStart(), $this->getEnd() - $this->getStart(), true);
    }
}
