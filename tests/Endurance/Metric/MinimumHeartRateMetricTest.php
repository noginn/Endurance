<?php

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;
use Endurance\Point;

class MinimumHeartRateMetricTest extends \PHPUnit_Framework_TestCase
{
    public $metric;

    public function setUp()
    {
        $this->metric = new MinimumHeartRateMetric();
        $this->zones = new HeartRateZones(array());
    }

    public function testCalculateReturnsZeroWithNoPoints()
    {
        $this->assertEquals(0, $this->metric->calculate(array(), $this->zones, array()));
    }

    public function testCalculateReturnsCorrectValue()
    {
        $this->assertEquals(90, $this->metric->calculate($this->createPoints(range(90,100)), $this->zones, array()));
    }

    private function createPoints(array $heartRates)
    {
        $points = array();
        foreach ($heartRates as $index => $heartRate) {
            $point = new Point();
            $point->setTime(new \DateTime('+' . ($index * 5) . ' seconds'));
            $point->setHeartRate($heartRate);
            $points[] = $point;
        }

        return $points;
    }
}
