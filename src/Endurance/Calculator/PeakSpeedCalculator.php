<?php 

namespace Endurance\Calculator;

use Endurance\PeakInterval;

class PeakSpeedCalculator
{
    public function calculate(array $points, $duration)
    {
        $count = count($points);
        if ($count === 0) {
            // No point data
            return;
        }

        $keys = array_keys($points);
        if ($points[$keys[$count - 1]]->getTimestamp() - $points[$keys[0]]->getTimestamp() < $duration) {
            return;
        }

        $intervals = array();
        for ($startIndex = 0; $startIndex < $count; $startIndex++) {
            for ($endIndex = $startIndex + 1; $endIndex < $count; $endIndex++) {
                $timeDelta = $points[$endIndex]->getTimestamp() - $points[$startIndex]->getTimestamp();
                if ($timeDelta >= $duration) {
                    $distanceDelta = $points[$endIndex]->getDistance() - $points[$startIndex]->getDistance();
                    $speed = $timeDelta > 0 ? ($distanceDelta / $timeDelta) * 3.6 : 0;

                    $intervals[] = new PeakInterval($startIndex, $endIndex, $speed);

                    // Break out of the loop
                    $endIndex = $count;
                }
            }
        }

        if (count($intervals) === 0) {
            // Found no intervals of the specified duration
            return;
        }

        // Sort the intervals by the metric
        usort($intervals, function ($a, $b) {
            if ($a->getMetric() === $b->getMetric()) {
                return 0;
            }

            return ($a->getMetric() > $b->getMetric()) ? -1 : 1;
        });

        return $intervals[0];
    }
}
