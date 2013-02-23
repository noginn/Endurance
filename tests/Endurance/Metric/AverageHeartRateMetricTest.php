<?php

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;
use Endurance\Point;

class AverageHeartRateMetricTest extends \PHPUnit_Framework_TestCase
{
    public $metric;

    public function setUp()
    {
        $this->metric = new AverageHeartRateMetric();
        $this->zones = new HeartRateZones(array());
    }

    public function testCalculateReturnsZeroWhenNoPoints()
    {
        $this->assertEquals(0, $this->metric->calculate(array(), $this->zones, array()));
    }

    public function testCalculateReturnsCorrectValue()
    {
        $points = $this->createPoints(range(100,200));

        $this->assertEquals(150, $this->metric->calculate($points, $this->zones, array()));
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
