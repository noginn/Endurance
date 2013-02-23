<?php

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;

class TimeInHeartRateZoneMetric extends Metric
{
    public function calculate(array $points, HeartRateZones $zones, array $dependencies)
    {
        $zone = $zones->getZone($this->options['zone']);

        $count = count($points);
        if ($count < 2) {
            return 0;
        }

        $seconds = 0;
        $indexes = array_keys($points);
        $lastIndex = $indexes[count($points) - 1];
        for ($index = $indexes[0] + 1; $index < $lastIndex; $index++) {
            if ($zone->inZone($points[$index]->getHeartRate())) {
                $interval = $points[$index]->getTimestamp() - $points[$index - 1]->getTimestamp();
                if ($interval <= 10) {
                    // Don't count time when paused
                    $seconds += $interval;
                }
            }
        }

        return $seconds;
    }
}
