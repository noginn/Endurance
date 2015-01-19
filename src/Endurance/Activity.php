<?php

namespace Endurance;

class Activity
{
    /**
     * The sport of the activity
     *
     * @var string
     */
    protected $sport;

    /**
     * The time when the ride started
     *
     * @var \DateTime
     */
    protected $startTime;

    /**
     * Points
     *
     * @var array
     */
    protected $points = array();

    /**
     * Lap summaries
     *
     * @var array
     */
    protected $laps = array();

    public function setSport($sport)
    {
        $this->sport = $sport;
    }

    public function getSport()
    {
        return $this->sport;
    }

    public function setStartTime(\DateTime $startTime)
    {
        $this->startTime = $startTime;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function addPoint(Point $point)
    {
        $this->points[] = $point;
    }

    public function setPoints(array $points)
    {
        $this->points = array();
        foreach ($points as $point) {
            $this->addPoint($point);
        }
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function addLap(Lap $lap)
    {
        $this->laps[] = $lap;
    }

    public function setLaps(array $laps)
    {
        $this->laps = array();
        foreach ($laps as $lap) {
            $this->addLap($lap);
        }
    }

    public function getLap($index)
    {
        return $this->laps[$index];
    }

    public function getLaps()
    {
        return $this->laps;
    }
}
