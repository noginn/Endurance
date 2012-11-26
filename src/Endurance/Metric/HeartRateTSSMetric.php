<?php 

namespace Endurance\Metric;

use Endurance\HeartRateZones;
use Endurance\Metric;

class HeartRateTSSMetric extends Metric
{
    public function calculate(array $points, HeartRateZones $zones, array $dependencies)
    {
        $tss = 0;
        foreach ($this->getZoneMultipliers() as $zone => $multiplier) {
            $tss += ($dependencies[$zone] / 3600) * $multiplier;
        }

        return round($tss);
    }

    public function loadDependencies()
    {
        $metrics = array();
        foreach (array_keys($this->getZoneMultipliers()) as $zone) {
            $metrics[$zone] = new TimeInHeartRateZoneMetric(array('zone' => $zone));
        }

        return $metrics;
    }

    private function getZoneMultipliers()
    {
        return array(
            'Z1-' => 20, 
            'Z1' => 30, 
            'Z1+' => 40, 
            'Z2-' => 50, 
            'Z2+' => 60, 
            'Z3' => 70, 
            'Z4' => 80, 
            'Z5a' => 100, 
            'Z5b' => 120, 
            'Z5c' => 140
        );
    }
}
