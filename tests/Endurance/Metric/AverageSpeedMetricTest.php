<?php 

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;
use Endurance\Point;

class AverageSpeedMetricTest extends \PHPUnit_Framework_TestCase
{
    public $metric;

    public function setUp()
    {
        $this->metric = new AverageSpeedMetric();
        $this->zones = new HeartRateZones(array());
    }

    public function testCalculateReturnsZeroWhenElapsedTimeIsZero()
    {
        $this->assertEquals(0, $this->metric->calculate(array(), $this->zones, array(
            'elapsedTime' => 0, 
            'totalDistance' => 1000
        )));
    }
    
    public function testCalculateReturnsSpeedInKmh()
    {
        $this->assertEquals(3.6, $this->metric->calculate(array(), $this->zones, array(
            'elapsedTime' => 100, 
            'totalDistance' => 100
        )));
    }
}
