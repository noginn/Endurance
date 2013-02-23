<?php

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;
use Endurance\Point;

class MaximumSpeedMetricTest extends \PHPUnit_Framework_TestCase
{
    public $metric;

    public function setUp()
    {
        $this->metric = new MaximumSpeedMetric();
        $this->zones = new HeartRateZones(array());
    }

    public function testCalculateReturnsZeroWithNoPoints()
    {
        $this->assertEquals(0, $this->metric->calculate(array(), $this->zones, array()));
    }

    public function testCalculateReturnsCorrectValue()
    {
        $this->assertEquals(100, $this->metric->calculate($this->createPoints(range(0,100)), $this->zones, array()));
    }

    private function createPoints(array $speeds)
    {
        $points = array();
        foreach ($speeds as $index => $speed) {
            $point = new Point();
            $point->setTime(new \DateTime('+' . ($index * 5) . ' seconds'));
            $point->setSpeed($speed);
            $points[] = $point;
        }

        return $points;
    }
}
