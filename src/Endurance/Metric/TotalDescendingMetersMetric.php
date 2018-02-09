<?php

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;

class TotalDescendingMetersMetric extends Metric
{
    public function calculate(array $points, HeartRateZones $zones, array $dependencies)
    {
        $meters = 0;

        $count = count($points);
        if ($count > 0) {
            $keys = array_keys($points);
            for ($index = $keys[0] + 1; $index < $count; $index++) {
                $descent = intval($points[$index]->getElevation()) - intval($points[$index - 1]->getElevation());

                if ($descent >= 0) {
                    $meters += $descent;
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
