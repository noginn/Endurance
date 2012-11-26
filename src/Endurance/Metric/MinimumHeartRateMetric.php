<?php 

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;

class MinimumHeartRateMetric extends Metric
{
    public function calculate(array $points, HeartRateZones $zones, array $dependencies)
    {
        return (int) min(array_map(function ($point) {
            return $point->getHeartRate();
        }, $points));
    }
}
