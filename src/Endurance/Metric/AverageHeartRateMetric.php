<?php

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;

class AverageHeartRateMetric extends Metric
{
    public function calculate(array $points, HeartRateZones $zones, array $dependencies)
    {
        $count = count($points);
        $values = array_map(function ($point) {
            return $point->getHeartRate();
        }, $points);

        return $count > 0 ? array_sum($values) / $count : 0;
    }
}
