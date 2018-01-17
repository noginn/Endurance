<?php

namespace Endurance\Scenarios;

use Endurance\Calculator\MetricCalculator;
use Endurance\HeartRateZone;
use Endurance\HeartRateZones;
use Endurance\Metric\MovingTimeMetric;
use Endurance\Metric\TimeInHeartRateZoneMetric;
use Endurance\Parser\TCXParser;

class PausedRideTest extends \PHPUnit\Framework\TestCase
{
    public $activity;
    public $calculator;
    public $zones;

    public function setUp()
    {
        $parser = new TCXParser();
        $this->activity = $parser->parse(__DIR__ . '/Fixtures/paused_ride.tcx');

        $this->calculator = new MetricCalculator();
        $this->zones = new HeartRateZones(array());
    }

    public function testMovingTimeMetricIgnoresPausedTime()
    {
        $metrics = array('movingTime' => new MovingTimeMetric());

        $values = $this->calculator->calculate($metrics, $this->activity->getPoints(), $this->zones);
        $this->assertEquals(4698, $values['movingTime']);
    }

    public function testTimeInHeartRateZoneMetricIgnoresPausedTime()
    {
        $metrics = array('timeInHRZone' => new TimeInHeartRateZoneMetric(array('zone' => 'Z2')));

        // When paused I was in the following zone
        $zones = new HeartRateZones(array(new HeartRateZone('Z2', '', 145, 158)));

        $values = $this->calculator->calculate($metrics, $this->activity->getPoints(), $zones);
        $this->assertEquals(1730, $values['timeInHRZone']);
    }
}
