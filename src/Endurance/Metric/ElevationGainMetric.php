<?php 

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;

class ElevationGainMetric extends Metric
{
    public function calculate(array $points, HeartRateZones $zones, array $dependencies)
    {
        $count = count($points);
        if ($count < 2) {
            return 0;
        }

        $gain = 0;
        $keys = array_keys($points);
        for ($index = $keys[0] + 1; $index < $count; $index++) {
            $difference = $points[$index]->getElevation() - $points[$index - 1]->getElevation();
            if ($difference > 0) {
                $gain += $difference;
            }
        }

        return $gain;
    }
}
