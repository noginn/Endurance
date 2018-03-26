<?php

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;

class MinimumCadenceMetric extends Metric
{
    public function calculate(array $points, HeartRateZones $zones, array $dependencies)
    {
        if (count($points) === 0) {
            return 0;
        }

        $cadences = array_map(function ($point) {
            return $point->getCadence();
        }, $points);

        $cadences = array_filter($cadences, function ($cadence) {
            return $cadence !== null && $cadence > 0;
        });

        if (count($cadences) == 0) {
            return null;
        }

        return (int) min($cadences);
    }
}
