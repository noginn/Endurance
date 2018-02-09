<?php

namespace Endurance\Calculator;

use Endurance\HeartRateZones;

class LapMetricCalculator
{
    protected $calculatedValues;

    public function calculate(array $metrics, array $laps, HeartRateZones $zones)
    {
        // Reset the calculated values
        $this->calculatedValues = array();

        return $this->calculateMetrics($metrics, $laps, $zones);
    }

    protected function calculateMetrics(array $metrics, array $laps, HeartRateZones $zones)
    {
        $values = array();

        foreach ($metrics as $key => $metric) {
            $hash = $metric->getHash();
            if (!isset($calculatedValues[$hash])) {
                $dependencies = $this->calculateMetrics($metric->getDependencies(), $laps, $zones);
                $this->calculatedValues[$hash] = $metric->calculate($laps, $zones, $dependencies);
            }

            $values[$key] = $this->calculatedValues[$hash];
        }

        return $values;
    }
}
