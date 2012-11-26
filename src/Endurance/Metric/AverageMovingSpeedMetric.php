<?php 

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;

class AverageMovingSpeedMetric extends Metric
{
    public function calculate(array $points, HeartRateZones $zones, array $dependencies)
    {
        $movingTime = $dependencies['movingTime'];
        $totalDistance = $dependencies['totalDistance'];

        return $movingTime > 0 ? ($totalDistance / $movingTime) * 3.6 : 0;
    }

    public function loadDependencies()
    {
        return array(
            'movingTime' => new MovingTimeMetric(),
            'totalDistance' => new TotalDistanceMetric()
        );
    }
}
