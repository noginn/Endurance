<?php 

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;

class TimeInHeartRateZoneMetric extends Metric
{
    public function calculate(array $points, HeartRateZones $zones, array $dependencies)
    {
        $zone = $zones->getZone($this->options['zone']);

        $seconds = 0;
        $indexes = array_keys($points);
        $lastIndex = $indexes[count($points) - 1];
        for ($index = $indexes[0] + 1; $index < $lastIndex; $index++) {
            if ($zone->inZone($points[$index]->getHeartRate())) {
                $seconds += $points[$index]->getTimestamp() - $points[$index - 1]->getTimestamp();
            }
        }

        return $seconds;
    }
}
