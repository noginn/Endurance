<?php

namespace Endurance\Metric;

use Endurance\HeartRateZones;

class MovingTimeMetricTest extends \PHPUnit\Framework\TestCase
{
    public $metric;

    public function setUp()
    {
        $this->metric = new MovingTimeMetric();
        $this->zones = new HeartRateZones(array());
    }

    public function testCalculateReturnsElapsedTimeWhenNoPoints()
    {
        $this->assertEquals(2000, $this->metric->calculate(array(), $this->zones, array(
            'elapsedTime' => 2000
        )));
    }
}
