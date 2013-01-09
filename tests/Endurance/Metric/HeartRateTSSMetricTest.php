<?php 

namespace Endurance\Metric;

use Endurance\HeartRateZone;
use Endurance\HeartRateZones;
use Endurance\Metric;
use Endurance\Point;

class HeartRateTSSMetricTest extends \PHPUnit_Framework_TestCase
{
    public $metric;

    public function setUp()
    {
        $this->metric = new HeartRateTSSMetric();
        $this->zones = new HeartRateZones(array(
            new HeartRateZone('Z1-', '', 0, 40),
            new HeartRateZone('Z1', '', 41, 80),
            new HeartRateZone('Z1+', '', 81, 120),
            new HeartRateZone('Z2-', '', 121, 130),
            new HeartRateZone('Z2+', '', 131, 140),
            new HeartRateZone('Z3', '', 141, 150),
            new HeartRateZone('Z4', '', 151, 160),
            new HeartRateZone('Z5a', '', 161, 170),
            new HeartRateZone('Z5b', '', 171, 180),
            new HeartRateZone('Z5c', '', 181, 190)
        ));
    }

    public function testCalculateReturnsZeroWithNoTimeSpentInZones()
    {
        $this->assertEquals(0, $this->metric->calculate(array(), $this->zones, array(
            'Z1-' => 0,
            'Z1' => 0,
            'Z1+' => 0,
            'Z2-' => 0,
            'Z2+' => 0,
            'Z3' => 0,
            'Z4' => 0,
            'Z5a' => 0,
            'Z5b' => 0,
            'Z5c' => 0
        )));
    }

    public function testCalculateReturnsCorrectValue()
    {
        // An hour spent in each zone, so we expect a score that is the sum of each multiplier
        $this->assertEquals(710, $this->metric->calculate(array(), $this->zones, array(
            'Z1-' => 3600,
            'Z1' => 3600,
            'Z1+' => 3600,
            'Z2-' => 3600,
            'Z2+' => 3600,
            'Z3' => 3600,
            'Z4' => 3600,
            'Z5a' => 3600,
            'Z5b' => 3600,
            'Z5c' => 3600
        )));
    }
}
