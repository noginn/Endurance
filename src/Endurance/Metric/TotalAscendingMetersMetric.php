<?php

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;

class TotalAscendingMetersMetric extends Metric
{
    public function calculate(array $points, HeartRateZones $zones, array $dependencies)
    {
        $meters = 0;

        $count = count($points);
        if ($count > 0) {
            $keys = array_keys($points);
            for ($index = $keys[0] + 1; $index < $count; $index++) {
                $elevation = intval($points[$index - 1]->getElevation()) - intval($points[$index]->getElevation());

                if ($elevation >= 1) {
                    $meters += $elevation;
                }
            }
        }

        return $meters;
    }

    protected function loadDependencies()
    {
        return array(
        );
    }
}
