<?php 

namespace Endurance\Calculator;

use Endurance\HeartRateZone;
use Endurance\HeartRateZones;

class HeartRateZoneCalculator
{
    /**
     * Calculates the training zones based on the given lactate threshold
     * heart rate of the athlete.
     * 
     * @param int $threshold The lactate threshold heart rate
     * @return HeartRateZones
     */
    public function calculateZones($threshold)
    {
        return new HeartRateZones(array(
            new HeartRateZone('Z1', 'Active recovery', 0, round($threshold * 0.81)),
            new HeartRateZone('Z2', 'Aerobic threshold', round($threshold * 0.81) + 1, round($threshold * 0.89)),
            new HeartRateZone('Z3', 'Tempo', round($threshold * 0.89) + 1, round($threshold * 0.93)),
            new HeartRateZone('Z4', 'Sub-lactate threshold', round($threshold * 0.93) + 1, round($threshold * 0.99)),
            new HeartRateZone('Z5a', 'Lactate threshold', round($threshold * 0.99) + 1, round($threshold * 1.02)),
            new HeartRateZone('Z5b', 'Aerobic capacity', round($threshold * 1.02) + 1, round($threshold * 1.06)),
            new HeartRateZone('Z5c', 'Anaerobic capacity', round($threshold * 1.06) + 1, 210)
        ));
    }

    /**
     * Calculates the extended training zones based on the given lactate threshold
     * heart rate of the athelete. Used to calculate stress score.
     * 
     * @param int $threshold The lactate threshold heart rate
     * @return HeartRateZones
     */
    public function calculateExtendedZones($threshold)
    {
        return new HeartRateZones(array(
            new HeartRateZone('Z1-', 'Active recovery low', 0, round($threshold * 0.27)),
            new HeartRateZone('Z1', 'Active recovery', round($threshold * 0.27) + 1, round($threshold * 0.54)),
            new HeartRateZone('Z1+', 'Active recovery high', round($threshold * 0.54) + 1, round($threshold * 0.81)),
            new HeartRateZone('Z2-', 'Aerobic threshold low', round($threshold * 0.81) + 1, round($threshold * 0.85)),
            new HeartRateZone('Z2+', 'Aerobic threshold high', round($threshold * 0.85) + 1, round($threshold * 0.89)),
            new HeartRateZone('Z3', 'Tempo', round($threshold * 0.89) + 1, round($threshold * 0.93)),
            new HeartRateZone('Z4', 'Sub-lactate threshold', round($threshold * 0.93) + 1, round($threshold * 0.99)),
            new HeartRateZone('Z5a', 'Lactate threshold', round($threshold * 0.99) + 1, round($threshold * 1.02)),
            new HeartRateZone('Z5b', 'Aerobic capacity', round($threshold * 1.02) + 1, round($threshold * 1.06)),
            new HeartRateZone('Z5c', 'Anaerobic capacity', round($threshold * 1.06) + 1, 210)
        ));
    }
}
