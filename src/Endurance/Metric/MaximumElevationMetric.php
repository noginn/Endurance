<?php 

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;

class MaximumElevationMetric extends Metric
{
    public function calculate(array $points, HeartRateZones $zones, array $dependencies)
    {
        return (int) max(array_map(function ($point) {
            return $point->getElevation();
        }, $points));
    }
}
