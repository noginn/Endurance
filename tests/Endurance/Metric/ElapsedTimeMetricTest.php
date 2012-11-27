<?php 

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;
use Endurance\Point;

class ElapsedTimeMetricTest extends \PHPUnit_Framework_TestCase
{
    public $metric;

    public function setUp()
    {
        $this->metric = new ElapsedTimeMetric();
        $this->zones = new HeartRateZones(array());
    }

    public function testCalculateReturnsZeroWithNoPoints()
    {
        $this->assertEquals(0, $this->metric->calculate(array(), $this->zones, array()));
    }
    
    public function testCalculateReturnsCorrectValue()
    {
        $this->assertEquals(45, $this->metric->calculate($this->createPoints(10), $this->zones, array()));
    }

    private function createPoints($numPoints)
    {
        $points = array();
        for ($index = 0; $index < $numPoints; $index++) {
            $time = new \DateTime();
            $time->setTimestamp($index * 5);

            $point = new Point();
            $point->setTime($time);
            $points[] = $point;
        }

        return $points;
    }
}
