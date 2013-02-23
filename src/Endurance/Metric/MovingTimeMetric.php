<?php 

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;

class MovingTimeMetric extends Metric
{
    public function calculate(array $points, HeartRateZones $zones, array $dependencies)
    {
        $movingTime = $dependencies['elapsedTime'];

        $count = count($points);
        if ($count > 0) {
            $keys = array_keys($points);
            for ($index = $keys[0] + 1; $index < $count; $index++) {
                $interval = $points[$index]->getTimestamp() - $points[$index - 1]->getTimestamp();
                if ($interval > 10 || $points[$index]->getSpeed() <= 1) {
                    $movingTime -= $interval;
                }
            }
        }

        return $movingTime;
    }

    protected function loadDependencies()
    {
        return array(
            'elapsedTime' => new ElapsedTimeMetric()
        );
    }
}
