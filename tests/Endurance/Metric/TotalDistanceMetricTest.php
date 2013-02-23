<?php

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;
use Endurance\Point;

class TotalDistanceMetricTest extends \PHPUnit_Framework_TestCase
{
    public $metric;

    public function setUp()
    {
        $this->metric = new TotalDistanceMetric();
        $this->zones = new HeartRateZones(array());
    }

    public function testCalculateReturnsZeroWithNoPoints()
    {
        $this->assertEquals(0, $this->metric->calculate(array(), $this->zones, array()));
    }

    public function testCalculateReturnsDistanceValueWhenOnlyOnePoint()
    {
        $this->assertEquals(2, $this->metric->calculate($this->createPoints(array(2)), $this->zones, array()));
    }

    public function testCalculateReturnsCorrectValueWhenStartingAtZero()
    {
        $this->assertEquals(100, $this->metric->calculate($this->createPoints(range(0,100)), $this->zones, array()));
    }

    public function testCalculateReturnsCorrectValueWhenNotStartingAtZero()
    {
        $this->assertEquals(50, $this->metric->calculate($this->createPoints(range(50,100)), $this->zones, array()));
    }

    private function createPoints(array $distances)
    {
        $points = array();
        foreach ($distances as $index => $distance) {
            $point = new Point();
            $point->setTime(new \DateTime('+' . ($index * 5) . ' seconds'));
            $point->setDistance($distance);
            $points[] = $point;
        }

        return $points;
    }
}
