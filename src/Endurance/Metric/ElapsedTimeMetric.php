<?php 

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;

class ElapsedTimeMetric extends Metric
{
    public function calculate(array $points, HeartRateZones $zones, array $dependencies)
    {
        $keys = array_keys($points);
        $start = $points[$keys[0]];
        $end = $points[$keys[count($keys) - 1]];

        return $end->getTimestamp() - $start->getTimestamp();
    }
}
