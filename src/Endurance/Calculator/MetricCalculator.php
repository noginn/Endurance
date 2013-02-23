<?php

namespace Endurance\Calculator;

use Endurance\HeartRateZones;

class MetricCalculator
{
    protected $calculatedValues;

    public function calculate(array $metrics, array $points, HeartRateZones $zones)
    {
        // Reset the calculated values
        $this->calculatedValues = array();

        return $this->calculateMetrics($metrics, $points, $zones);
    }

    protected function calculateMetrics(array $metrics, array $points, HeartRateZones $zones)
    {
        $values = array();

        foreach ($metrics as $key => $metric) {
            $hash = $metric->getHash();
            if (!isset($calculatedValues[$hash])) {
                $dependencies = $this->calculateMetrics($metric->getDependencies(), $points, $zones);
                $this->calculatedValues[$hash] = $metric->calculate($points, $zones, $dependencies);
            }

            $values[$key] = $this->calculatedValues[$hash];
        }

        return $values;
    }
}
