<?php 

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;
use Endurance\Point;

class AverageMovingSpeedMetricTest extends \PHPUnit_Framework_TestCase
{
    public $metric;

    public function setUp()
    {
        $this->metric = new AverageMovingSpeedMetric();
        $this->zones = new HeartRateZones(array());
    }

    public function testCalculateReturnsZeroWhenMovingTimeIsZero()
    {
        $this->assertEquals(0, $this->metric->calculate(array(), $this->zones, array(
            'movingTime' => 0, 
            'totalDistance' => 1000
        )));
    }
    
    public function testCalculateReturnsSpeedInKmh()
    {
        $this->assertEquals(3.6, $this->metric->calculate(array(), $this->zones, array(
            'movingTime' => 100, 
            'totalDistance' => 100
        )));
    }
}
