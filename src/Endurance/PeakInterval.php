<?php 

namespace Endurance;

class PeakInterval
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

    /**
     * The peak metric
     * 
     * @var float
     */
    protected $metric;

    public function __construct($start = 0, $end = 0, $metric = 0)
    {
        $this->setStart($start);
        $this->setEnd($end);
        $this->setMetric($metric);
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

    public function setMetric($metric)
    {
        $this->metric = (float) $metric;
    }

    public function getMetric()
    {
        return $this->metric;
    }

    public function filterPoints(array $points)
    {
        return array_slice($points, $this->getStart(), $this->getEnd() - $this->getStart(), true);
    }
}
