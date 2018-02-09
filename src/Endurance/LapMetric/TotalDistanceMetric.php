<?php

namespace Endurance\LapMetric;

use Endurance\HeartRateZones;
use Endurance\LapMetric;

class TotalDistanceMetric extends LapMetric
{
    public function calculate(array $laps, HeartRateZones $zones, array $dependencies)
    {
        $count = count($laps);
        if ($count === 0) {
            return 0;
        }

        $distance = 0;
        foreach ($laps as $lap) {
            $distance += $lap->getDistance();
        }

        return $distance;
    }
}
