<?php

namespace Endurance\Metric;

use Endurance\HeartRateZone;
use Endurance\HeartRateZones;
use Endurance\Metric;
use Endurance\Point;

class TimeInHeartRateZoneMetricTest extends \PHPUnit_Framework_TestCase
{
    public $metric;

    public function setUp()
    {
        $this->metric = new TimeInHeartRateZoneMetric(array('zone' => 'Z1'));
        $this->zones = new HeartRateZones(array(new HeartRateZone('Z1', '', 120, 130)));
    }

    public function testCalculateReturnsZeroWithNoPoints()
    {
        $this->assertEquals(0, $this->metric->calculate(array(), $this->zones, array()));
    }

    public function testCalculateReturnsCorrectValue()
    {
        $this->assertEquals(55, $this->metric->calculate($this->createPoints(range(100,200)), $this->zones, array()));
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
