<?php 

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;
use Endurance\Point;

class ElevationGainMetricTest extends \PHPUnit_Framework_TestCase
{
    public $metric;

    public function setUp()
    {
        $this->metric = new ElevationGainMetric();
        $this->zones = new HeartRateZones(array());
    }

    public function testCalculateReturnsZeroWithNoPoints()
    {
        $this->assertEquals(0, $this->metric->calculate(array(), $this->zones, array()));
    }
    
    public function testCalculateReturnsCorrectValue()
    {
        // Up 100m, down 100m and up 100m again
        $this->assertEquals(200, $this->metric->calculate($this->createPoints(array_merge(range(0,100), range(100,0), range(0,100))), $this->zones, array()));
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
