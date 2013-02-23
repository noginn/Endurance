<?php

namespace Endurance;

class Lap
{
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

    public function filterPoints(array $points)
    {
        return array_slice($points, $this->getStart(), $this->getEnd() - $this->getStart(), true);
    }
}
