<?php

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;

class TotalDistanceMetric extends Metric
{
    public function calculate(array $points, HeartRateZones $zones, array $dependencies)
    {
        $count = count($points);
        if ($count === 0) {
            return 0;
        }

        $keys = array_keys($points);
        $start = $points[$keys[0]];
        if ($count === 1) {
            return $start->getDistance();
        }

        $keys_count = count($keys);
        $end_index = 1;
        $end = $points[$keys[$keys_count - $end_index]];

        while ($end->getDistance() == 0 && $end_index < $keys_count) {
            $end_index += 1;
            $end = $points[$keys[$keys_count - $end_index]];
        }

        return $end->getDistance() - $start->getDistance();
    }
}
