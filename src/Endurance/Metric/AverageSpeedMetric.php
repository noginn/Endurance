<?php 

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;

class AverageSpeedMetric extends Metric
{
    public function calculate(array $points, HeartRateZones $zones, array $dependencies)
    {
        $elapsedTime = $dependencies['elapsedTime'];
        $totalDistance = $dependencies['totalDistance'];

        return $elapsedTime > 0 ? ($totalDistance / $elapsedTime) * 3.6 : 0;
    }

    protected function loadDependencies()
    {
        return array(
            'elapsedTime' => new ElapsedTimeMetric(),
            'totalDistance' => new TotalDistanceMetric()
        );
    }
}
