<?php

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;
use Endurance\Point;

class MinimumElevationMetricTest extends \PHPUnit\Framework\TestCase
{
    public $metric;

    public function setUp()
    {
        $this->metric = new MinimumElevationMetric();
        $this->zones = new HeartRateZones(array());
    }

    public function testCalculateReturnsZeroWithNoPoints()
    {
        $this->assertEquals(0, $this->metric->calculate(array(), $this->zones, array()));
    }

    public function testCalculateReturnsCorrectValue()
    {
        $this->assertEquals(25, $this->metric->calculate($this->createPoints(range(25,100)), $this->zones, array()));
    }

    private function createPoints(array $elevations)
    {
        $points = array();
        foreach ($elevations as $index => $elevation) {
            $point = new Point();
            $point->setTime(new \DateTime('+' . ($index * 5) . ' seconds'));
            $point->setElevation($elevation);
            $points[] = $point;
        }

        return $points;
    }
}
