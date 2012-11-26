<?php 

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;

class ElevationLossMetric extends Metric
{
    public function calculate(array $points, HeartRateZones $zones, array $dependencies)
    {
        $loss = 0;
        $count = count($points);
        $keys = array_keys($points);
        for ($index = $keys[0] + 1; $index < $count; $index++) {
            $difference = $points[$index]->getElevation() - $points[$index - 1]->getElevation();
            if ($difference < 0) {
                $loss -= $difference;
            }
        }

        return $loss;
    }
}
