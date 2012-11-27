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

        $end = $points[$keys[count($keys) - 1]];

        return $end->getDistance() - $start->getDistance();
    }
}
